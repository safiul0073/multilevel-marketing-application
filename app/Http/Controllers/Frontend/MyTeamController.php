<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MyTeamController extends Controller
{
    public function userTeamView (Request $request) {
        $att = $this->validate($request, [
            'username'   => 'nullable|string|exists:users,username'
        ]);

        $trees = User::query()->with('image')->select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children' => fn ($q) => $q->with('image')]);

        if (isset($att['username'])) {
            $trees->where('username',$att['username']);
        }else {
            $trees->whereNull('sponsor_id');
        }
        return view('frontend.contents.dashboard.my_team', ['trees' => $trees->get()]);
    }
}
