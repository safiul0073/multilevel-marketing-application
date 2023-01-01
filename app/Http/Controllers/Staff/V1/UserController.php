<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Product;
use App\Models\User;
use App\Services\UserService;
use App\Traits\Formatter;
use App\Traits\MediaOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    use Formatter, MediaOperator;

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
    public function index(Request $request)
    {
        $perPage = 10;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }
        $users = User::select(['id','first_name', 'sponsor_id','last_name','username', 'email', 'phone', 'country', 'created_at', 'balance'])
                       ->with('sponsor:id,username')
                       ->orderBy('id', 'asc');

        if ($request->search) {
            $users->whereLike(['username', 'email'], $request->search);
        }

        return $this->withSuccess($users->paginate($perPage));
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
            'main_sponsor_id' => 'required|numeric|exists:users,id',
            'select_sponsor_id'=>'required|numeric|exists:users,id',
            'refer_position' => 'nullable|string|in:left,right',
            'product_id' => 'required|numeric|exists:products,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'username' => 'required|string|min:4|unique:users',
            'email' => 'required|string',
            'phone' => 'required|min:11',
            'password' => 'required|string|min:8',
            'epin_code' => 'required|string|exists:epins,code'
        ]);

        $product = Product::find((int)$att['product_id']);

        try {
            DB::beginTransaction();
            if (!$this->user_service->checkTwoSponsorSamePosition($att['main_sponsor_id'],$att['select_sponsor_id'])){
                throw new Exception('Please select valid sponsor!');
            }
            $user = $this->user_service->userCreate($att);

            if ($request->epin_code) {
                $this->user_service->checkEpinAndUpdate($request->epin_code, $product, $user);
            }

            // position setting
            $sponsor = $this->user_service->setReferPosition($att['select_sponsor_id'],
                        $user->id,
                        (isset($att['refer_position']) ? $att['refer_position'] : 'left'));

            // generation label creating
            Generation::create([
                'main_id' => $sponsor->id,
                'member_id' => $user->id,
                'gen_type' => 1
            ]);

            // generation looping
            $i = 2;
            $this->user_service->generationLoop($sponsor->id, $user->id, $att['refer_position'], $i);
            // bonus given'
            $this->user_service->bonusGiven($att['main_sponsor_id'], $user->id,$att['refer_position']);
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

        return $this->withSuccess($user);
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
            'refer_position' => 'nullable|between:"left","right"',
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
