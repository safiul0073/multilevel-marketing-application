<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Traits\MediaOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserInfoController extends Controller
{
    use MediaOperator;

    public function profile () {
        $user = User::find(auth()->id())->load(['nominee', 'image', 'info']);
        // dd($user);
        return view('frontend.contents.profile.index', ['user' => $user]);
    }

    public function update (UserUpdateRequest $request) {


        $user = User::find(auth()->id());

        try {
            DB::beginTransaction();
                $user->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'isUpdated' => 2
                ]);

                // update user info
                $user->info()->create([
                    'profession'    => $request->profession,
                    'gender'    => $request->gender,
                    'nid_number'    => $request->nid_number,
                    'father_name'   => $request->father_name,
                    'mother_name'   => $request->mother_name,
                    'address'   => $request->address,
                    'birthday'  => $request->birthday,
                ]);

                // user image upload
                if ($request->avatar) {
                    $this->singleFileUpload(
                        $this->uploadFile($request->avatar),
                        $user,
                        'profile'
                    );
                }

                // nominee info upload

                $nominee =  $user->nominee()->create([
                                'nominee_name' => $request->nominee_name,
                                'relation' => $request->relation,
                                'nominee_profession' => $request->nominee_profession,
                                'nominee_birthday' => $request->nominee_birthday,
                                'nominee_gender' => $request->nominee_gender,
                                'nominee_nid' => $request->nominee_nid,
                                'nominee_father' => $request->nominee_father,
                                'nominee_mother' => $request->nominee_mother,
                                'nominee_phone' => $request->nominee_phone,
                                'nominee_address' => $request->nominee_address
                            ]);
                // upload nominee image
                if ($request->nominee_image) {
                    $this->singleFileUpload(
                        $this->uploadFile($request->nominee_image),
                        $nominee,
                        'nominee_image'
                    );
                }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }
        return redirect()->back()->with('success', 'Successfully info update. Please wait to confirm.');
    }

    public function changePassView () {

        return view('frontend.contents.dashboard.change_password');
    }

    public function changePassword (Request $request) {

        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::find(auth()->id());
        if (Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success', 'Successfully changed your password.');
        }

        return redirect()->back()->with('error', "Old password doesn't match! Please enter your old password.");

    }
}
