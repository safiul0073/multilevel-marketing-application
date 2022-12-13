<?php

namespace App\Http\Controllers\Staff;

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
        $users = User::select(['id','first_name', 'sponsor_id','last_name','username', 'email', 'phone', 'country', 'created_at', 'balance'])
                       ->with('sponsor:id,username')
                       ->whereNotNull('sponsor_id')
                       ->orderBy('id', 'asc');

        if ($request->search) {
            $users->whereLike(['username', 'email'], $request->search);
        }

        return $this->withSuccess($users->paginate(10));
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
            'sponsor_id' => 'required|numeric|exists:users,id',
            'refer_position' => 'nullable|string',
            'product_id' => 'required|numeric|exists:products,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'username' => 'required|string|min:4|unique:users',
            'email' => 'required|string',
            'phone' => 'required|min:11',
            'password' => 'required|string|min:8',
            'avatar'    => ['nullable', File::types(['jpg','png', 'jpeg'])->min(50)->max(2*1000)]
        ]);
        $sponsor = User::find((int) $att['sponsor_id']);
        $userAtt = $att;
        if (isset($userAtt['password'])) {
            $userAtt['password'] = Hash::make($userAtt['username']);
        }
        unset($userAtt['product_id']);
        unset($userAtt['refer_position']);
        $product = Product::find((int)$att['product_id']);
        try {
            DB::beginTransaction();
            $user = User::create($userAtt);
            if (! $user) {
                throw new Exception('User not create!');
            }
            // position setting
            $this->user_service->setReferPosition($att['sponsor_id'],
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

            $user->purchases()->create([
                'product_id' => $att['product_id'],
                'amount' => $product->price,
            ]);
            // generation looping
            $i = 2;
            $this->user_service->generationLoop($sponsor->id, $user->id, $att['refer_position'], $i);
            // bonus given'
            $this->user_service->bonusGiven($sponsor->id, $user->id,$att['refer_position']);
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
