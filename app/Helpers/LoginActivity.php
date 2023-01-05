<?php
namespace App\Helpers;
use App\Models\LoginLog;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;

class LoginActivity
{

    public static function addToLog()
    {
    	$log = [];
        $ip = Request::ip();
    	$log['ip'] = $ip;
        $log['location'] = json_encode(Location::get($ip), true);
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = auth()->check() ? auth()->id() : 1;
    	LoginLog::create($log);
    }


    public static function logActivityLists()
    {
    	return LoginLog::latest()->get();
    }


}
