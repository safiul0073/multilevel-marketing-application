<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Bonuse;
use App\Models\User;
use App\Traits\Formatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserHelperController extends Controller
{
    use Formatter;

    public function userBinaryTreeData (Request $request) {

        $att = $this->validate($request, [
            'username'   => 'nullable|string|exists:users,username'
        ]);

        $users = User::query()->with('image')->select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children' => fn ($q) => $q->with('image')]);

        if (isset($att['username'])) {
            $users->where('username',$att['username']);
        }else {
            $users->whereNull('sponsor_id');
        }
        return $this->withSuccess($users->get());
    }

    public function getUserList () {

        $users = User::select(['id as value', 'username as label', 'left_ref_id', 'right_ref_id'])->get();

        return $this->withSuccess($users);
    }

    public function userDetailsCalculation ($id) {

        $details = User::withSum(['bonuses as gen_bonus'
                            => fn ($query) => $query->where('bonus_type', 'gen') ],'amount')
                        ->withSum('purchases as purchase_amount', 'amount')
                        ->withSum(['bonuses as total_today_bonus'
                            => fn ($query) => $query->whereDate('created_at', today()) ],'amount')
                        ->withSum(['bonuses as matching_bonus'
                            => fn ($query) => $query->where('bonus_type', 'matching') ],'amount')
                        ->withSum(['bonuses as referral_bonus'
                            => fn ($query) => $query->where('bonus_type', 'joining') ],'amount')
                        ->with(['image', 'nominee'])

                        ->where('id', (int) $id)->first();
        return $this->withSuccess($details);
    }

    public function passwordReset (Request $request) {

        $request->validate([
            'id'   => 'required|numeric|exists:users,id',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find((int) $request->id);

        $user->password = Hash::make($request->password);
        $user->save();
        return $this->withSuccess('Successfully changed password.');

    }


    public function userLoginFromDashboard (User $user) {

        Auth::login($user);
        return redirect()->route('login');
    }

    public function userReferrals ($id) {

        $perPage = 10;
        if (request()->perPage) {
            $perPage = request()->perPage;
        }
        $referrals = Bonuse::with('bonus_for:id,first_name,last_name,username,phone,email,created_at')->where('given_id', $id)->where('bonus_type', 'joining')->paginate($perPage);
        return $this->withSuccess($referrals);
    }

    public function userBalanceUpdate (Request $request, User $user) {

        $att = $this->validate($request, [
                    'type'  => 'required|string|in:add,sub',
                    'amount'=> 'required|numeric|min:50',
                    'message' => 'required|string|max:256'
                ]);
        try {
            DB::beginTransaction();

            $user->transactions()->create($att);
            $success_message = '';
            if ($request->type == 'add') {
                $user->balance = $user->balance + $request->amount;
                $success_message = 'Amount successfully added into main balance.';

            }else {
                $user->balance = $user->balance - $request->amount;
                $success_message = 'Amount successfully subtract from main balance.';
            }
            $user->save();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess($success_message);
    }
}
