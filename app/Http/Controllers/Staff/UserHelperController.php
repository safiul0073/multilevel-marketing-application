<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserHelperController extends Controller
{
    use Formatter;

    public function userBinaryTreeData (Request $request) {

        $att = $this->validate($request, [
            'username'   => 'nullable|string|exists:users,username'
        ]);

        $users = User::query()->select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children']);

        if (isset($att['username'])) {
            $users->where('username',$att['username']);
        }else {
            $users->whereNull('sponsor_id');
        }
        return $this->withSuccess($users->get());
    }

    public function getUserList () {

        $users = User::select(['id as value', 'username as label'])->get();

        return $this->withSuccess($users);
    }

    public function userDetailsCalculation ($id) {

        $details = User::withSum(['bonuses as gen_bonus'
                            => fn ($query) => $query->where('bonus_type', 'gen') ],'amount')
                        ->withSum(['bonuses as matching_bonus'
                            => fn ($query) => $query->where('bonus_type', 'matching') ],'amount')
                        ->withSum(['bonuses as referral_bonus'
                            => fn ($query) => $query->where('bonus_type', 'joining') ],'amount')
                        ->withSum('transactions as total_transaction', 'amount')
                        ->where('id', (int) $id)->first();
        return $this->withSuccess($details);
    }

    public function passwordReset (Request $request) {

        $request->validate([
            'id'   => 'required|numeric|exists:users,id',
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find((int) $request->id);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->withSuccess('Successfully changed password.');
        }

        return $this->withErrors('Old password not match! Please enter valid old password.');
    }

    public function getOnlyUserBinaryTree ($id) {

        $users = User::select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children'])->where('id', $id)->first();

        return $this->withSuccess($users);
    }
}
