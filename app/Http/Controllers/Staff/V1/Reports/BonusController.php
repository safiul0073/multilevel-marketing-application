<?php

namespace App\Http\Controllers\Staff\V1\Reports;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Traits\Formatter;
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

        $matchings = Bonuse::with('bonus_got:id,username')->where('bonus_type', $bonus_type)
                            ->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($matchings);
    }
}
