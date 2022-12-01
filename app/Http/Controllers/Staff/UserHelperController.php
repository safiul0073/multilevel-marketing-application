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
            'user_id'   => 'nullable|numeric|exists:users,id'
        ]);

        $users = User::select(['id','referrance_id', 'left_ref_id', 'right_ref_id']);
        return $this->withSuccess($users->get());
    }
}
