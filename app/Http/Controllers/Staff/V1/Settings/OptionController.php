<?php

namespace App\Http\Controllers\Staff\V1\Settings;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Option;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    use Formatter;

    public function getBonus () {

        return $this->withSuccess(config('mlm.bonus'));
    }

    public function getTransferCharge () {

        return $this->withSuccess(config('mlm.balance_transfer'));
    }

    public function getOfficeSettings () {

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
            'name' => 'required|string',
            'is_full_data' => 'nullable'
        ]);

        $option = null;

        if ($request->is_full_data) {
            $option = Option::where('name', $request->name)->first();
        }else{
            $option = Option::getOption($request->name);
        }

        return $this->withSuccess($option);
    }

    public function getMediaImage (Request $request)
    {
        $this->validate($request, [
            'id'    => 'required',
            'type'  => 'required'
        ]);

        $option = Media::where([
                        'media_id' => (int) $request->id,
                        'type' => $request->type
                    ])->get();

        return $this->withSuccess($option);

    }
}
