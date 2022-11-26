<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;

class UserHelperController extends Controller
{
    use Formatter;

    public function userBinaryTreeData (Request $request) {

        $att = $this->validate($request, [
            'user_id'   => 'required|numeric|exists:users,id'
        ]);

        $users = User::query();
        return $this->withSuccess($users->latest()->get());
    }
}
