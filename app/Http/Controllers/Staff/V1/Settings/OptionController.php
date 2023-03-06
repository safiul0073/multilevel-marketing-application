<?php

namespace App\Http\Controllers\Staff\V1\Settings;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\TaskScheduler;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    use Formatter;

    public function getBonus (Request $request) {

        return $this->withSuccess(config('mlm.bonus'));
    }

    public function getTransferCharge (Request $request) {

        return $this->withSuccess(config('mlm.balance_transfer'));
    }

    public function getOfficeSettings (Request $request) {

        return $this->withSuccess(config('mlm.footer'));
    }

    public function getHomeContent () {

        return $this->withSuccess(config('mlm.home_content'));
    }

    public function storeOption (Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'value'=> 'required'
        ]);

        Option::updateOption( $request->name, is_array($request->value) ? json_encode($request->value) : $request->value);

        return $this->withSuccess('Successfully saved setting.');
    }

    public function getOptionValue (Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $option = Option::getOption($request->name);
        
        return $this->withSuccess($option);
    }
}
