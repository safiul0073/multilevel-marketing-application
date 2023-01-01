<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class RewardController extends Controller
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
        $products = Reward::orderBy('id', 'DESC')->paginate($perPage);

        return $this->withSuccess($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att = $this->validate($request, [
            'designation' => 'required|string|max:255',
            'right_count' => 'required|numeric',
            'left_count' => 'required|numeric',
            'travel_destination' => 'required|string|max:255',
            'one_time_bonus' => 'required|string',
            'salary' => 'required|numeric'
        ]);

        Reward::create($att);

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
        return $this->withSuccess($reward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $att = $this->validate($request, [
            'id'    => 'required|numeric|exists:rewards,id',
            'designation' => 'required|string|max:255',
            'right_count' => 'required|numeric',
            'left_count' => 'required|numeric',
            'travel_destination' => 'required|string|max:255',
            'one_time_bonus' => 'required|string',
            'salary' => 'required|numeric'
        ]);
        $reward = Reward::find((int) $att['id']);
        $reward->update($att);

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
