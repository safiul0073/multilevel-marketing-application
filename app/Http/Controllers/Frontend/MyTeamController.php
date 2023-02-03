<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class MyTeamController extends Controller
{
    public function userTeamView (Request $request) {
        $att = $this->validate($request, [
            'username'   => 'nullable|string|exists:users,username'
        ]);

        $trees = User::query()->with('image')->select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children' => fn ($q) => $q->with('image')]);

        if (isset($att['username'])) {
            
            $user = User::where('username', $att['username'])->first();

            if (UserService::checkGivenUserAreBelongToAuthUser($user->sponsor_id)) {
                $trees->where('username',$att['username']);
            }else {
                $trees->where('username', auth()->user()->username);
            }

        }else {
            $trees->where('username', auth()->user()->username);
        }

        return view('frontend.contents.dashboard.my_team', ['trees' => $trees->get()]);
    }
}
