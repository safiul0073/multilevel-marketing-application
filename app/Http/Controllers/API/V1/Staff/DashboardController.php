<?php

namespace App\Http\Controllers\API\V1\Staff;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('staff.dashboard');
    }
}
