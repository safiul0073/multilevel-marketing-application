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

        $users = User::query()->select(['id', 'first_name', 'last_name', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children']);

        if (isset($att['user_id'])) {
            $users->where('id',$att['user_id']);
        }else {
            $users->whereNull('sponsor_id');
        }
        return $this->withSuccess($users->get());
    }

    public function getUserList () {

        $users = User::select(['id as value', 'username as label'])->get();

        return $this->withSuccess($users);
    }

    public function getUserDetails ($id) {

        // $user = User
    }
}
