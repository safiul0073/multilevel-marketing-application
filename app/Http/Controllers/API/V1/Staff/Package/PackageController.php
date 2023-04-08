<?php

namespace App\Http\Controllers\API\V1\Staff\Package;

use App\Models\Product;
use App\Traits\Formatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Services\ApiIndexQueryService;
use App\Services\Package\PackageService;

class PackageController extends Controller
{
    use Formatter;

    public function __construct(
        protected PackageService $service
    )
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiIndexQueryService::indexQuery(
            Product::query()->where('is_package',1),
            ['category:id,title'],
            ['name']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        return $this->service->store($request->validated(), "Package");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $package)
    {
        if ($package->is_package) {
            return $this->withSuccess($package->load('images'));
        }
        return $this->withNotFound('not found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, Product $package)
    {
        return $this->service
                    ->update($request->validated(), $package, "Package");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $package)
    {
        return $this->service->delete($package, "Package");
    }
}
