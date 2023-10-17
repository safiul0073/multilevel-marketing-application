<?php

namespace App\Http\Controllers\API\V1\Staff\Epin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpinMainRequest;
use App\Models\EpinMain;
use App\Models\Product;
use App\Services\ApiIndexQueryService;
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
        return ApiIndexQueryService::indexQuery(
            EpinMain::query(),
            ['epins', 'product:id,name'],
            ['customer_name',
            'customer_phone',
            'product.name'
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpinMainRequest $request)
    {
        try {
            DB::beginTransaction();

            $att = $request->validated();
            unset($att['code']);

            $epin_main = EpinMain::create($att);

            $epin_main->epins()->createMany(
                array_map(function ($code){
                    return [
                        'code' => $code
                    ];
                }, $request->code)
            );

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
    public function update(EpinMainRequest $request, EpinMain $epin)
    {

        try {
            DB::beginTransaction();
            $epin->update($request->validated());
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
        try {
            DB::beginTransaction();
            $epin->epins()->delete();
            $epin->delete();
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }
        return $this->withSuccess('Successfully deleted.');
    }
}
