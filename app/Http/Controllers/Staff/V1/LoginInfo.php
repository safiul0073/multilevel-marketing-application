<?php

namespace App\Http\Controllers\Staff\V1;

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
    public function __invoke(Request $request)
    {
        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }
        $infos = LoginLog::latest()->paginate($perPage);

        return $this->withSuccess($infos);
    }
}
