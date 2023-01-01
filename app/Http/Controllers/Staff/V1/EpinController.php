<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Epin;
use App\Models\EpinMain;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpinController extends Controller
{
    use Formatter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $epins = EpinMain::with('epins', 'product:id,name')->orderBy('id', 'desc')->paginate($perPage);

        return $this->withSuccess($epins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'cost'          => 'required|numeric',
            'type'          => 'required|string',
            'code.*'        => 'required|string|unique:epins,code',
            'quantity'      => 'required|numeric|max:100',
            'product_id'    => 'required|numeric|exists:products,id',
            'customer_name' => 'required|string|max:56',
            'customer_phone'=> 'required|string|min:11|max:12',
        ]);

        try {
            DB::beginTransaction();

            $epin_main = EpinMain::create([
                'cost'          => $request->cost,
                'type'          => $request->type,
                'quantity'      => $request->quantity,
                'product_id'    => $request->product_id,
                'customer_name' => $request->customer_name,
                'customer_phone'=> $request->customer_phone,
            ]);

            $epins = [];
            foreach($request->code as $code) {
                $epins[] = [
                    'code'  => $code
                ];
            }

            $epin_main->epins()->createMany($epins);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function show(EpinMain $epin)
    {
        return $this->withSuccess($epin->load(['epins' => fn ($q) => $q->with('use_by:id,username') ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required|numeric|exists:epin_mains,id',
            'cost'          => 'required|numeric',
            'type'          => 'required|string',
            'product_id'    => 'required|numeric|exists:products,id',
            'customer_name' => 'required|string|max:56',
            'customer_phone'=> 'required|string|min:11|max:12',
        ]);

        try {
            DB::beginTransaction();

            $epin_main = EpinMain::find((int) $request->id);
            $e = $epin_main->update([
                    'cost'          => $request->cost,
                    'type'          => $request->type,
                    'product_id'    => $request->product_id,
                    'customer_name' => $request->customer_name,
                    'customer_phone'=> $request->customer_phone,
                ]);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Epin  $epin
     * @return \Illuminate\Http\Response
     */
    public function destroy(EpinMain $epin)
    {
        $epin->epins()->delete();
        $epin->delete();

        return $this->withSuccess('Successfully deleted.');
    }
}
