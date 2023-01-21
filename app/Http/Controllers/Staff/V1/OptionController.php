<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    use Formatter;

    public function getBonus (Request $request) {

        return $this->withSuccess(config('mlm.bonus'));

    }

    public function storeOption (Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'value'=> 'required'
        ]);

        Option::updateOption( $request->name, is_array($request->value) ? json_encode($request->value) : $request->value);

        return $this->withSuccess('Successfully saved setting.');
    }
}
