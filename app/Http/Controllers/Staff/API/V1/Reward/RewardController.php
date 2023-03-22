<?php

namespace App\Http\Controllers\Staff\API\V1\Reward;

use App\Http\Controllers\Controller;
use App\Http\Requests\RewardRequest;
use App\Models\Reward;
use App\Services\ApiIndexQueryService;
use App\Services\RewardService;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class RewardController extends Controller
{
    use Formatter, MediaOperator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiIndexQueryService::indexQuery(Reward::query());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RewardRequest $request)
    {

        try {
            DB::beginTransaction();

            $reward = Reward::create($request->validated());

            RewardService::checkUserForReward($reward);

            if (is_array($request->images)) {

                $this->multiFileUpload(
                    array_map(function ($image) {
                        return $this->uploadFile($image);
                    }, $request->images),
                    $reward,
                    'reward'
                );

            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        return $this->withSuccess($reward->load('images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(RewardRequest $request, Reward $reward)
    {

        try {
            DB::beginTransaction();

            $reward->update($request->validated());

            RewardService::checkUserForReward($reward);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        $reward->delete();

        return $this->withSuccess('Successfully deleted.');
    }
}
