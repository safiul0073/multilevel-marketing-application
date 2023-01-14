<?php

namespace App\Services;

use App\Models\Bonuse;
use App\Models\Epin;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Product;
use App\Models\Reward;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService {

    protected $gen_bonus;

    protected $matching_bonus;

    protected $join_bonus;

    public function __construct()
    {
       $this->gen_bonus      = config('mlm.bonus.gen');
       $this->matching_bonus = config('mlm.bonus.matching');
       $this->join_bonus     = config('mlm.bonus.joining');
    }

    private function userAtt (array $att):Array {
        return [
            'email' => $att['email'],
            'phone' => $att['phone'],
            'password'  => Hash::make($att['password']),
            'username'  => $att['username'],
            'last_name' => $att['last_name'],
            'first_name'    => $att['first_name'],
            'sponsor_id'    => $att['select_sponsor_id'],
        ];
    }

    public function userCreate (array $att):User {
        return User::create($this->userAtt($att));
    }

    public function checkTwoSponsorSamePosition ($main_sponsor_id, $select_sponsor_id) {
        $sponsor = User::find((int) $select_sponsor_id);
        if (!$sponsor) return false;
        if ($sponsor->id === (int) $main_sponsor_id) {
            return true;
        }else{
            if ($sponsor) {
                return $this->checkTwoSponsorSamePosition($main_sponsor_id, $sponsor->sponsor_id);
            }
        }
    }

    /**
     * @epin_code type string.
     * @product type Product
     * @user type User
     * @return Product
     **/
    public function checkEpinAndUpdate (string $epin_code, $product, User $user):Product {
        $epin = Epin::with('epin_main')->where('code', $epin_code)->first();
        if($epin && $epin->status == 1) throw new Exception('Epin already used. Please use new epin.');
        if ($product && $epin->epin_main->product_id != $product->id) throw new Exception('Sorry package not match! Please use valid package epin!');
        $epin->status = 1;
        $epin->use_by = $user->id;
        $epin->activation_date = now();
        $epin->save();
        return ($product ? $product : $epin->epin_main->product);
    }
    /**
     * @position type string between left or right.
     * @sponsor_id type int parent id
     * @referrer_id type int child id
     * @return User
     **/
    public function setReferPosition (int $sponsor_id, int $referrer_id, string $position = 'left',):User

    {
        $sponsor = User::find((int) $sponsor_id);

        if ($position != 'auto') {
            if ($position === 'left' && !$sponsor->left_ref_id) {
                $sponsor->left_ref_id = $referrer_id;
            }else if ($position === 'right' && !$sponsor->right_ref_id){
                $sponsor->right_ref_id = $referrer_id;
            }else {
                if ($position === 'left' && $sponsor->left_ref_id) {
                    throw new Exception('left position already fill up!');
                }else if ($position === 'right' && $sponsor->right_ref_id){
                    throw new Exception('right position already fill up!');
                }

            }
        }else {
            $sponsor = $this->findRealSponsor($sponsor_id, $referrer_id, $position);
        }
        $this->referCount($sponsor, $referrer_id);

        return $sponsor;
    }

    private function findRealSponsor ($children_id, $referrer_id, $position):User {

        $children = User::find((int) $children_id);

        if ($children->left_ref_id && $children->right_ref_id) {
            if ($position == 'left') {
                return $this->findRealSponsor($children->left_ref_id, $referrer_id, $position);
            }else{
                return $this->findRealSponsor($children->right_ref_id, $referrer_id, $position);
            }
        }else if (!$children->left_ref_id) {
            $children->left_ref_id = $referrer_id;
            return $children;
        }else{
            $children->right_ref_id = $referrer_id;
            return $children;
        }
    }

    public function referCount ($sponsor, $user_id):void {

        if ($this->findPosition($sponsor, $user_id)  == 'left') {
            $increased_count = $sponsor->left_group + 1;
            $sponsor->left_group = $increased_count;
            $this->checkMatchingPair($sponsor->right_group, $increased_count, $sponsor->id, $user_id);
        }else{
            $increased_count = $sponsor->right_group + 1;
            $sponsor->right_group = $increased_count;
            $this->checkMatchingPair($sponsor->left_group, $increased_count, $sponsor->id, $user_id);
        }
        $sponsor->save();
    }

    public function findPosition ($sponsor, $user_id):string {
        if ($sponsor->left_ref_id === $user_id) {
            return 'left';
        }else{
            return 'right';
        }
    }

    public function checkMatchingPair ($opposite_count, $increased_count, $sponsor_id, $user_id) {

        if ($opposite_count >= $increased_count) {
            // MatchingPair::create([
            //     'parent_id' => $sponsor_id,
            //     'match_count'     => $increased_count,
            //     'user_id'   => $user_id,
            // ]);
            $this->matchingBonus($sponsor_id, $user_id);
        }

    }

    /**
     * @generation looping from 1 - 10.
     * @$sponsor_id int
     * @user_id who joined
     * $i loop index
     * @return void
     */
    public function generationLoop (int $sponsor_id, int $user_id, string $position, int $i) {

        $sponsor = User::find((int) $sponsor_id);
        $sponsor_sponsor_id = $sponsor->sponsor_id;

        if ($sponsor_sponsor_id) {
            $sponsor_sponsor = User::find((int) $sponsor_sponsor_id);
            // sponsor group incrementing
            if ($sponsor_sponsor->left_ref_id == $sponsor->id) {
                $increased_count = $sponsor_sponsor->left_group + 1;
                $sponsor_sponsor->left_group = $increased_count;
                $this->checkMatchingPair($sponsor_sponsor->right_group, $increased_count, $sponsor_sponsor->id, $user_id);
            }else{
                $increased_count = $sponsor_sponsor->right_group + 1;
                $sponsor_sponsor->right_group = $increased_count;
                $this->checkMatchingPair($sponsor_sponsor->left_group, $increased_count, $sponsor_sponsor->id, $user_id);
            }
            $sponsor_sponsor->save();

            // generation label creating

            Generation::create([
                'main_id' => $sponsor_sponsor_id,
                'member_id' => $user_id,
                'gen_type' => $i
            ]);

            $i = $i + 1;

            return $this->generationLoop($sponsor_sponsor_id, $user_id,$position, $i);

        }
    }

     /**
     * @sponsor_id type int.
     * @user_id type int
     * @return void
     **/
    public function bonusGiven (int $sponsor_id, int $user_id):void {
        $this->joiningBonus($sponsor_id, $user_id);
        $this->generationBonus($user_id);
    }

     /**
     * @sponsor_id type int.
     * @user_id type int
     * @return void
     **/
    public function joiningBonus (int $sponsor_id, int $user_id):void {
        $this->bonusSave($sponsor_id, $user_id, 'joining', $this->join_bonus);
    }

     /**
     * @sponsor_id type int.
     * @user_id type int
     * @return void
     **/
    public function matchingBonus (int $parent_id, int $user_id) {

        // $matching_pairs = MatchingPair::where('user_id', $user_id)->get();

        // foreach($matching_pairs as $user) {

        $this->bonusSave($parent_id, $user_id, 'matching', $this->matching_bonus);

        // }

    }

    private function generationBonus ($user_id) {

        $gen_bonuses = $this->gen_bonus;
        $generations = Generation::where('member_id', $user_id)->where('gen_type', '<=', count($gen_bonuses))->get();

        foreach($generations as $gen) {
            $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[$gen->gen_type-1]);
        }
    }

    private function bonusSave ($sponsor_id, $user_id, $type, $amount) {
        Bonuse::create([
            'given_id'   => $sponsor_id,
            'bonus_type' => $type,
            'for_given_id'=> $user_id,
            'amount'      => $amount
        ]);
        $sponsor = User::find((int) $sponsor_id);
        $sponsor->balance = $sponsor->balance + $amount;
        $sponsor->save();
    }

    // public function checkReward($user):string {

    //     $rewards = Reward::select('designation', 'left_count', 'right_count')->get();
    //     foreach($rewards as $reward) {

    //     }
    // }
}
