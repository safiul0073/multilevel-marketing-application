<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\Purchase;
use App\Models\User;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Formatter;

    public function topEarned (Request $request) {

        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $query = User::query()->select('first_name', 'last_name','username', 'email', 'phone', 'balance')
                       ->withSum(['bonuses as top_earned' => function ($q) use($request) {
                            $q->when($request->from_date && $request->to_date, function ($q) use($request) {
                                $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                                $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
                                $q->whereBetween('updated_at', [$startDate, $endDate]);
                            });
                       }], 'amount');

        $users = $query->orderByDesc('top_earned')->paginate($perPage);

        return $this->withSuccess($users);
    }

    public function topSponsor (Request $request) {

        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $users = User::select('id','first_name', 'last_name', 'username', 'email', 'phone')
                    ->withCount(['bonuses as sponsor_count' => function ($q) use($request) {
                        $q->where('bonus_type', Bonuse::JOINING);
                        $q->when($request->from_date && $request->to_date, function ($q) use ($request) {
                            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
                            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
                            $q->whereBetween('created_at', [$startDate, $endDate]);
                        });
                    }])
                    ->orderByDesc('sponsor_count')->paginate($perPage);


        return $this->withSuccess($users);
    }


}
