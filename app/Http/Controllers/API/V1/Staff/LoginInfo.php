<?php

namespace App\Http\Controllers\API\V1\Staff;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
use App\Services\ApiIndexQueryService;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class LoginInfo extends Controller
{
    use Formatter;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserLoginActivity(Request $request, $id)
    {
        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }
        $infos = LoginLog::where('user_id', $id)->latest()->paginate($perPage);

        return $this->withSuccess($infos);
    }

    public function allUserLoginActivity ()
    {
        return ApiIndexQueryService::indexQuery(
            LoginLog::query(),
            ['user:id,username'],
            ['user.username']
        );
    }

    public function allUserLoginActivityExcel ()
    {
        return ApiIndexQueryService::indexQuery(
            LoginLog::query(),
            ['user:id,username'],
            ['user.username'],
            false
        );
    }
}
