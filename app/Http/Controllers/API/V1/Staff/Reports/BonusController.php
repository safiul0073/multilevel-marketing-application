<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BonusController extends Controller
{

    use Formatter;

    public function bonusList (Request $request) {

        $bonus_type = $request->bonus_type ?? Bonuse::MATCHING;

        $egerLoads = ['bonus_got:id,username'];

        if ($request->bonus_type == Bonuse::GENERATION) {
            $egerLoads = ['bonus_got:id,username', 'generation:id,gen_type'];
        }
        if ($request->bonus_type == Bonuse::JOINING) {
            $egerLoads = ['bonus_got:id,username', 'bonus_for' => fn ($q) => $q->with('sponsor:id,username,left_ref_id,right_ref_id')];
        }

        $query = Bonuse::query()->where('bonus_type', $bonus_type);

        return ApiIndexQueryService::indexQuery(
            $query,
            $egerLoads,
            ['bonus_got.username']
        );
    }


}
