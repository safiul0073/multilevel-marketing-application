<?php
namespace App\Helpers;
use App\Models\LoginLog;
use Illuminate\Support\Facades\Request;
use Stevebauman\Location\Facades\Location;
use Jenssegers\Agent\Agent;

class LoginActivity
{

    public static function addToLog()
    {
    	$log = [];
        $agent = new Agent();
        $ip =  Request::ip();
    	$log['ip'] = $ip;
        $log['location'] = Location::get($ip);
    	$log['agent'] = ['platform' => $agent->platform(), 'browser' => $agent->browser()];
    	$log['user_id'] = auth()->check() ? auth()->id() : 1;
    	LoginLog::create($log);
    }


    public static function logActivityLists()
    {
    	return LoginLog::latest()->get();
    }


}
