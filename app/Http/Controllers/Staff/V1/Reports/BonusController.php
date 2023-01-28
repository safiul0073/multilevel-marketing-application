<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BonusController extends Controller
{

    use Formatter;

    public function bonusList (Request $request) {

        $bonus_type = $request->bonus_type ?? 'matching';

        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }
        $egerLoads = 'bonus_got:id,username';

        if ($request->bonus_type == 'gen') {
            $egerLoads = ['bonus_got:id,username', 'generation:id,gen_type'];
        }
        if ($request->bonus_type == 'joining') {
            $egerLoads = ['bonus_got:id,username', 'bonus_for:id,username'];
        }

        $query = Bonuse::query()->with($egerLoads)->where('bonus_type', $bonus_type);

        if ($request->form_date && $request->to_date) {
            $startDate = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $matchings = $query->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($matchings);
    }


}
