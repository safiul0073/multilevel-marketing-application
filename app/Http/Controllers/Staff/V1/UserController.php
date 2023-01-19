<?php

namespace App\Http\Controllers\Staff\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Nominee;
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
        $users = User::with('mainSponsor:id,given_id,for_given_id,bonus_type')
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
            // if (!$this->user_service->checkTwoSponsorSamePosition($att['main_sponsor_id'],$att['select_sponsor_id'])){
            //     throw new Exception('Please select valid sponsor!');
            // }
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

            $user->purchases()->create([
                'product_id'    => $product->id,
                'amount'        => $product->price,
                'status'        => 1
            ]);

            // generation looping
            $i = 2;
            $this->user_service->generationLoop($sponsor->id, $user->id, $att['refer_position'], $i);
            // bonus given'
            $this->user_service->bonusGiven($att['main_sponsor_id'], $user->id,$att['refer_position']);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
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
        $values = [
            'full_name' => $user->first_name . ' ' . $user->last_name,
            'username'  => $user->username,
            'right'     => $user->right_group,
            'left'      => $user->left_group,
            'reward'    => 'Silver',
            'avatar'    => $user->image,
            'joined_date' => $user->created_at
        ];

        return $this->withSuccess($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {

        $user = User::find((int) $request->id);

        try {
            DB::beginTransaction();
                $user->update([
                    'first_name'    => $request->first_name,
                    'last_name' => $request->last_name,
                    'profession'    => $request->profession,
                    'gender'    => $request->gender,
                    'nid_number'    => $request->nid_number,
                    'father_name'   => $request->father_name,
                    'mother_name'   => $request->mother_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address'   => $request->address,
                    'birthday'  => $request->birthday,
                    'status' => $request->status == '1'? true : false ,
                    'email_verified_at' => $request->email_verified == '1'? now() : null,
                    'sms_verified_at' => $request->sms_verified == '1'? now() : null,
                    'isUpdated' => $request->isUpdated
                ]);

                $user->nominee()->updateOrCreate(['user_id' => $request->id],[
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
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->withErrors($ex->getMessage());
        }

        return $this->withSuccess('Successfully updated.');
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
