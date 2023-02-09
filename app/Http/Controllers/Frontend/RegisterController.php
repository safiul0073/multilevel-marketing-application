<?php

namespace App\Http\Controllers\Frontend;

use App\Events\PurchaseEvent;
use App\Http\Controllers\Controller;
use App\Models\Epin;
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
            'slug'  => ['nullable', 'string', 'exists:products,slug'],
            'sponsor_id' => ['nullable', 'string', 'exists:users,username'],
            'position' => ['nullable', 'string', 'in:left,right,auto'],
        ]);

        if (!$request->slug && !$request->sponsor_id){
            return redirect()->route('not.found');
        }

        return view('frontend.contents.buy.sponsor_field', [
            'slug' => $request->slug,
            'sponsor_id' => $request->sponsor_id,
            'position'  => $request->position,
            'map'   => $request->map
        ]);
    }

    public function checkSponsor (Request $request) {

        $this->validate($request, [
            'main_sponsor_username' => ['required', 'string', 'exists:users,username'],
            'slug' => ['nullable', 'string', 'exists:products,slug'],
            'sponsor_username' => ['nullable', 'string', 'exists:users,username'],
            'position' => ['required', 'string', 'in:left,right,auto']
        ]);

        // $sponsor = User::where('username', $request->username)->first();
        // $position = $request->position;
        // $isNotError = false;
        // if ($position != 'auto') {
        //     if ($position == 'left' && $sponsor->left_ref_id) {
        //         return redirect()->back()->with('error', 'left already fill up!');
        //     } else if ($position == 'right' && $sponsor->right_ref_id) {
        //         return redirect()->back()->with('error', 'right already fill up!');
        //     }else {
        //         $isNotError = true;
        //     }
        // }else {
        //     $isNotError = true;
        // }

        // if ($isNotError) {
            return view('frontend.contents.buy.user_field', [
                'slug' => $request->slug,
                'sponsor_username'    => $request->sponsor_username,
                'main_sponsor_username' => $request->main_sponsor_username,
                'position'  => $request->position
            ]);
        // }
    }

    public function checkUser (Request $request) {


        $this->validate($request, [
            'slug' => ['nullable', 'string', 'exists:products,slug'],
            'main_sponsor_username' => ['required', 'string', 'exists:users,username'],
            'sponsor_username' => ['nullable', 'string', 'exists:users,username'],
            'position' => ['required', 'string', 'in:left,right,auto'],
            'email'    => ['required', 'string', 'email', 'max:255'],
            'first_name'    => 'required|string',
            'last_name' => 'required|string',
            'phone'    => ['required', 'string', 'max:11'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $product = null;
        if ($request->slug) {
            $product = Product::with('category')->where('slug', $request->slug)->first();
        }

        return view('frontend.contents.buy.payment', [
            'main_sponsor_username' => $request->main_sponsor_username,
            'product' => $product,
            'slug'    => $request->slug,
            'sponsor_username'   => $request->sponsor_username,
            'position'  => $request->position,
            'first_name'  => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'password' => $request->password
        ]);
    }

    public function saveUser (Request $request) {

        $att = $this->validate($request, [
                    'slug' => ['nullable', 'string', 'exists:products,slug'],
                    'main_sponsor_username' => ['required', 'string', 'exists:users,username'],
                    'sponsor_username' => ['nullable', 'string', 'exists:users,username'],
                    'refer_position' => ['required', 'string', 'in:left,right,auto'],
                    'first_name'  => 'required|string',
                    'last_name' => 'required|string',
                    'email'    => ['required', 'string', 'email', 'max:255'],
                    'phone'    => ['required', 'string', 'max:11'],
                    'username' => ['required', 'string', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'],
                    'epin_code' => 'nullable|string|exists:epins,code'
                ]);
            if (!$request->epin_code && !$request->product_id) {
                return redirect()->back()->with('error', 'Please use E-pin code. for create a new user.');
            }
            $user_service = new UserService();

            $sponsor = User::where('username', isset($att['sponsor_username']) ? $att['sponsor_username'] : $att['main_sponsor_username'])->first();

            $att['select_sponsor_id'] = $sponsor->id;

            $main_sponsor = User::where('username', $att['main_sponsor_username'])->first();

            $product = Product::where('slug', $att['slug'])->first();

        try {
            DB::beginTransaction();

            // save the new user
            $user = $user_service->userCreate($att);

            if ($request->epin_code) {
              $product = $user_service->checkEpinAndUpdate($request->epin_code, $product, $user);
            }

            $sponsor = $user_service->setReferPosition($sponsor->id, $user->id, $att['refer_position']);

            // again sponsor_id save for original sponsor
            $user->sponsor_id = $sponsor->id;
            $user->save();

            // purchase creating
            PurchaseEvent::dispatch($user, $product);

            // generation looping
            $user_service->generationLoop($sponsor->id, $user->id, $user->id, $att['refer_position']);

            // bonus given
            $user_service->bonusGiven($main_sponsor->id, $user, $att['refer_position']);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->route('login')->with('success', 'Successfully registered.');
    }
}
