<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('staff.dashboard');
    }
}
