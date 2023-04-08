<?php

namespace App\Http\Controllers\API\V1\Staff;

use App\Http\Controllers\Controller;
use App\Models\LoginLog;
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
    public function __invoke(Request $request, $id)
    {
        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }
        $infos = LoginLog::where('user_id', $id)->latest()->paginate($perPage);

        return $this->withSuccess($infos);
    }
}
