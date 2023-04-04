<?php

namespace App\Http\Controllers\API\V1\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginFromDashboard extends Controller
{
    public function __invoke(User $user)
    {
        Auth::login($user);
        return redirect()->route('login');
    }
}
