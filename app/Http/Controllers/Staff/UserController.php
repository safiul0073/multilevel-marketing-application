<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Models\Product;
use App\Models\User;
use App\Services\UserService;
use App\Traits\Formatter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Formatter;

    protected $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['nominee', 'image'])->orderBy('id', 'asc')->paginate(10);

        return $this->withSuccess($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att = $this->validate($request, [
            'sponsor_id' => 'required|numeric|exists:users,username',
            'refer_psition' => 'nullable|string',
            'product_id' => 'required|numeric|exists:products,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'username' => 'required|string|min:4|unique:users',
            'email' => 'required|string|unique:users',
            'phone' => 'required|min:11|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $sopnsor = User::where('username', $request->sponsor_id)->first();
        $userAtt = $att;
        if (isset($userAtt['password'])) {
            $userAtt['password'] = Hash::make($userAtt['username']);
        }
        unset($userAtt['product_id']);
        unset($userAtt['refer_psition']);
        $product = Product::findOrFail($att['product_id']);
        try {
            DB::beginTransaction();
            $user = User::create($userAtt);
            if (! $user) {
                throw new Exception('User not create!');
            }
            // position setting
            $this->user_service->setReferPosition($att['referrance_id'],
            $user->id,
            (isset($att['refer_psition']) ? $att['refer_psition'] : 'left'));

            // sponser group updating
            $sopnsor->total_group = $sopnsor->total_group + 1;
            $sopnsor->save();
            // generation lavel creating
            Generation::create([
                'main_id' => $sopnsor->id,
                'member_id' => $user->id,
                'gen_type' => 1
            ]);

            // generation looping
            $i = 2;
            $this->user_service->generationLoop($sopnsor->username, $user->username, $i);
            $user->purchases()->create([
                'product_id' => $att['product_id'],
                'amount' => $product->price,
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('User successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->withSuccess($user->load('purchases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $att = $this->validate($request, [
            'referrance_id' => 'required|numeric|exists:users,id',
            'refer_psition' => 'nullable|between:"left","right"',
            'product_id' => 'required|numeric|exists:products,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'username' => 'required|string|min:4',
            'email' => 'required|string',
            'phone' => 'required|min:11',
            'password' => 'required|string|min:8',
        ]);

        if (isset($att['password'])) {
            $att['password'] = Hash::make($att['username']);
        }

        try {
            DB::beginTransaction();
            $u = $user->update($att);
            if (! $u) {
                throw new Exception('User not updated!');
            }
            DB::commit();
        } catch (\Exception $ex) {
            return $this->withErrors($ex->getMessage());
        }

        return $this->withCreated('User successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $this->withSuccess('User successfully deleted!');
    }
}
