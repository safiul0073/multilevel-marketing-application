<?php

namespace App\Http\Controllers\API\V1\Staff\DailyIncentive;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\IncentiveBonus;
use App\Models\User;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InceptiveBonusController extends Controller
{
    use Formatter;

    public function getIncentive () {

        return ApiIndexQueryService::indexQuery(
            IncentiveBonus::query(),
            [],
            ['amount']
        );
    }

    public function getIncentiveExcel()
    {
        return ApiIndexQueryService::indexQuery(
            IncentiveBonus::query(),
            [],
            ['amount'],
            false
        );
    }

    public function getCountForInceptiveUser (Request $request) {

        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date'   => 'required|date'
        ]);
        $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
        $userCount = User::whereBetween('created_at', [$startDate, $endDate])->count();

        return $this->withSuccess([
            'count' => $userCount
        ]);
    }

    public function distributeInceptiveBonus (Request $request) {

        $att = $this->validate($request, [
                    'from_date' => 'required|date',
                    'to_date'   => 'required|date',
                    'amount'    => 'required|numeric',
                    'count'     => 'required|numeric'
                ]);

        $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
        $userCount = User::whereBetween('created_at', [$startDate, $endDate])->count();

        try {
            DB::beginTransaction();
                // count matching check
                if ($request->count != $userCount) {
                    throw new \Exception('User Count not match! Please again search');
                }

                // bonus divide by user count
                $per_user_bonus = $request->amount / $userCount;

                // getting all user
                $users = User::select('id')->whereBetween('created_at', [$startDate, $endDate])->get()->toArray();
                $auth_user = User::find(auth()->id());

                // mapping and giving bonus
                $auth_user->incentiveBonusGive()->createMany(
                    array_map(function ($user) use($per_user_bonus) {
                        return [
                            'given_id' => $user['id'],
                            'bonus_type'   => Bonuse::INCENTIVE,
                            'amount'    => $per_user_bonus,
                            'status'    => false
                        ];
                    }, $users)
                );

                // now create inceptive table new row
                IncentiveBonus::create($att);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }
        return $this->withSuccess('Successfully given.');
    }


    public function dailyBonusReport () {

        return ApiIndexQueryService::indexQuery(
            Bonuse::query()->where('bonus_type', Bonuse::INCENTIVE),
            ['bonus_got:id,username'],
            ['bonus_got.username']
        );
    }

    public function dailyIncentiveExcelList ()
    {
        return ApiIndexQueryService::indexQuery(
            Bonuse::query()->where('bonus_type', Bonuse::INCENTIVE),
            ['bonus_got:id,username'],
            ['bonus_got.username'],
            false
        );

    }
}
