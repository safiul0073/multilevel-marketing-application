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

        $users = User::query()->select(['id','sponsor_id', 'left_ref_id', 'right_ref_id']);

        // if (isset($att['user_id'])) {
        //     $users->whereRelation('generations', 'main_id', $att['user_id']);
        // }
        return $this->withSuccess($users->get());
    }
}
