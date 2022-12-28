<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\EpinMain;
use App\Models\Product;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpinHelperController extends Controller
{
    use Formatter;

    public function storeEpin (Request $request) {

        $this->validate($request, [
            'epin_main_id' => 'required|numeric|exists:epin_mains,id',
            'code'       => 'required|string|unique:epins,code',
            'quantity'     => 'required|numeric'
        ]);

        $epin_main = EpinMain::find((int) $request->epin_main_id);

        try {
            DB::beginTransaction();

            $epin_main->epins()->create([
                'code'  => $request->code
            ]);

            $epin_main->quantity = $epin_main->quantity + $request->quantity;
            $epin_main->save();
            DB::commit();

        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('New epin created.');
    }

    public function getProductList () {

        $products = Product::select(['id as value', 'name as label', 'price'])->get();

        return $this->withSuccess($products);
    }

    public function deleteEpin ($id) {
        $epin = Epin::findOrFail((int) $id);
        if ($epin->status == 1) {
            return $this->withErrors('This epin activated.');
        }
        $epin->epin_main()->update([
            'quantity' => $epin->epin_main?->quantity - 1
        ]);
        $epin->delete();
        return $this->withSuccess('Successfully deleted.');
    }
}
