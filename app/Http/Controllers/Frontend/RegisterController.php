<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Product;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function setSponsor(Request $request) {

        $this->validate($request, [
            'slug'  => ['required', 'string', 'exists:products,slug']
        ]);

        return view('frontend.contents.buy.sponsor_field', ['slug' => $request->slug]);
    }

    public function checkSponsor (Request $request) {

        if (!$request->slug) {
            return back();
        }
        $this->validate($request, [
            'slug' => ['required', 'string', 'exists:products,slug'],
            'username' => ['required', 'string', 'exists:users,username'],
            'position' => ['required', 'string', 'in:left,right']
        ]);



        $sponsor = User::where('username', $request->username)->first();
        $position = $request->position;
        if ($sponsor->left_ref_id && $sponsor->left_ref_id) {

            return redirect()->back()->with('error', 'Please select another sponsor!');

        }else if (($position === 'left' && !$sponsor->left_ref_id)
                || ($position === 'right' && !$sponsor->right_ref_id)) {

            return view('frontend.contents.buy.user_field', [
                'slug' => $request->slug,
                'sponsor_id'    => $request->username,
                'position'  => $request->position
            ]);
        }else {
            return redirect()->back()->with('error', 'Please select valid position or sponsor!');
        }
    }

    public function checkUser (Request $request) {

        if (!$request->slug) {
            return back();
        }

        $this->validate($request, [
            'slug' => ['required', 'string', 'exists:products,slug'],
            'sponsor_id' => ['required', 'string', 'exists:users,username'],
            'position' => ['required', 'string', 'in:left,right'],
            'email'    => ['required', 'string', 'email', 'max:255'],
            'first_name'    => 'required|string',
            'last_name' => 'required|string',
            'phone'    => ['required', 'string', 'max:11'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $product = Product::with('category')->where('slug', $request->slug)->first();
        return view('frontend.contents.buy.payment', [
            'product' => $product,
            'slug'    => $request->slug,
            'sponsor_id'   => $request->sponsor_id,
            'position'  => $request->position,
            'first_name'    => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password
        ]);
    }

    public function saveUser (Request $request) {
        if (!$request->slug) {
            return back();
        }
        $att = $this->validate($request, [
                    'slug' => ['required', 'string', 'exists:products,slug'],
                    'sponsor_id' => ['required', 'string', 'exists:users,username'],
                    'refer_position' => ['required', 'string', 'in:left,right'],
                    'first_name'  => 'required|string',
                    'last_name' => 'required|string',
                    'email'    => ['required', 'string', 'email', 'max:255'],
                    'phone'    => ['required', 'string', 'max:11'],
                    'username' => ['required', 'string', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'],
                    'epin_code' => 'required|string|exists:epins,code'
                ]);

        $user_service = new UserService();
        $sponsor = User::where('username', $att['sponsor_id'])->first();
        $att['sponsor_id'] = $sponsor->id;
        $userAtt = $att;
        if (isset($userAtt['password'])) {
            $userAtt['password'] = Hash::make($userAtt['username']);
        }

        $userAtt['password'] = Hash::make($request->password);
        unset($userAtt['epin_code']);
        unset($userAtt['slug']);
        unset($userAtt['refer_position']);
        $product = Product::where('slug', $att['slug'])->first();

        try {
            DB::beginTransaction();
            $isEpin = false;

            $user = User::create($userAtt);

            if ($request->epin_code) {
                $user_service->checkEpinAndUpdate($request->epin_code, $product, $user);
                $isEpin = true;
            }

            if (! $user) {
                throw new Exception('User not create!');
            }

            $user->purchases()->create([
                'product_id' => $product->id,
                'amount' => $product->price,
                'status' => $isEpin ? 1 : 0
            ]);
            // position setting
            $user_service->setReferPosition($sponsor->id,
            $user->id,
            (isset($att['refer_position']) ? $att['refer_position'] : 'left'));

            // sponsor group incrementing
            if ($att['refer_position'] == 'left') {
                $sponsor->left_group = $sponsor->left_group + 1;
            }else{
                $sponsor->right_group = $sponsor->right_group + 1;
            }

            $sponsor->save();
            // generation label creating
            Generation::create([
                'main_id' => $sponsor->id,
                'member_id' => $user->id,
                'gen_type' => 1
            ]);

            MatchingPair::create([
                'parent_id' => $sponsor->id,
                'parent_position' => $att['refer_position'],
                'count'     => 1,
                'user_id'   => $user->id,
                'position'  => $att['refer_position']
            ]);

            if ($request->avatar) {
                $this->singleFileUpload(
                $this->uploadFile($request->avatar),
                $user,
                'profile');
            }
            // generation looping
            $i = 2;
            $user_service->generationLoop($sponsor->id, $user->id, $att['refer_position'], $i);
            // bonus given'
            $user_service->bonusGiven($sponsor->id, $user->id,$att['refer_position']);
            DB::commit();
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->route('login')->with('success', 'Successfully registered new agent.');
    }
}
