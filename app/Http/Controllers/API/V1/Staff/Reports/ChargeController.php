<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class ChargeController extends Controller
{

    use Formatter;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $perPage = 10;

        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $charges = Charge::with('holder')->orderByDesc('id')->paginate($perPage);

        return $this->withSuccess($charges);
    }
}
