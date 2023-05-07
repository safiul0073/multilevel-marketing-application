<?php

namespace App\Http\Controllers\API\V1\Staff\Reports;

use App\Http\Controllers\Controller;
use App\Models\RewardUser;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RewardController extends Controller
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
        $query = RewardUser::query();

        return ApiIndexQueryService::indexQuery(
            $query,
            ['user:id,username,first_name,last_name,email,phone'],
            ['user.username','name'],
            !$request->isNotPaginate
        );
    }
}
