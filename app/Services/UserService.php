<?php

namespace App\Services;

use App\Models\Bonuse;
use App\Models\Epin;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Transaction;
use App\Models\User;
use Exception;

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

    public function checkEpinAndUpdate ($epin_code, $product, $user) {
        $epin = Epin::with('epin_main')->where('code', $epin_code)->first();
        if($epin && $epin->status == 1) throw new Exception('Epin already used. Please use new epin.');
        if ($epin->epin_main->product_id != $product->id) throw new Exception('Sorry package not match! Please use valid package epin!');
        $epin->status = 1;
        $epin->use_by = $user->id;
        $epin->activation_date = now();
        $epin->save();
    }
    /**
     * @position type string between left or right.
     * @refferrenc_id type int perent id
     * @referrer_id type int chiled id
     * @return void
     */
    public function setReferPosition (int $sponsor_id, int $referrer_id, string $position = 'left',):void {

        if (!in_array($position, ['left', 'right'])) {
            throw new Exception('please select left or right');
        }

        $user = User::find((int) $sponsor_id);
        if ($position === 'left') {
            if ($user->left_ref_id) {
                throw new Exception('Left is already fill up!');
            }else {
                $user->left_ref_id = $referrer_id;
            }
        }else {
            if ($user->right_ref_id) {
                throw new Exception('Right is already fill up!');
            }else {
                $user->right_ref_id = $referrer_id;
            }
        }

        $user->save();
    }


    /**
     * @reneration looping from 1 - 10.
     * @$sponser_id int
     * @user_id who joined
     * $i loop index
     * @return void
     */
    public function generationLoop (int $sponsor_id, int $user_id, $position,  $i) {

        $sponsor = User::find((int) $sponsor_id);
        $sponsor_sponsor_id = $sponsor->sponsor_id;

        if ($sponsor_sponsor_id) {
            $sponsor_sponsor = User::find((int) $sponsor_sponsor_id);
            // sponsor group incrementing
            if ($sponsor_sponsor->left_ref_id == $sponsor->id) {
                $sponsor_sponsor->left_group = $sponsor_sponsor->left_group + 1;
                    MatchingPair::create([
                        'parent_id' => $sponsor_sponsor->id,
                        'parent_position' => 'left',
                        'count'     => $i,
                        'user_id'   => $user_id,
                        'position'  => $position
                    ]);
            }else{
                $sponsor_sponsor->right_group = $sponsor_sponsor->right_group + 1;
                    MatchingPair::create([
                        'parent_id' => $sponsor_sponsor->id,
                        'parent_position' => 'right',
                        'count'     => $i,
                        'user_id'   => $user_id,
                        'position'  => $position
                    ]);
            }
            $sponsor_sponsor->save();
            // generation label creating

            if (count($this->gen_bonus) >= $i) {
                Generation::create([
                    'main_id' => $sponsor_sponsor_id,
                    'member_id' => $user_id,
                    'gen_type' => $i
                ]);
            }

            $i = $i + 1;

            return $this->generationLoop($sponsor_sponsor_id, $user_id,$position, $i);

        }
    }


     /**
     * @reneration looping from 1 - 10.
     * @$sponser_id int
     * @user_id who joined
     * $i loop index
     * @return void
     */
    public function bonusGiven ($sponsor_id, $user_id, $side) {

        // first joining bonus given
        $sponsor = User::find((int) $sponsor_id);
        $bonus = $this->join_bonus;
        $sponsor->balance = $sponsor->balance + $bonus;
        $sponsor->save();
        $sponsor->bonuses()->create([
            'bonus_type' => 'joining',
            'for_given_id'=> $user_id,
            'amount'      => $bonus
        ]);
        $this->matchingBonus($user_id, $side);
        $this->generationBonus($user_id);
    }

    public function matchingBonus ($user_id, $side) {

        $matching_pairs = MatchingPair::where('user_id', $user_id)->where('position', $side)->get();
        if ($side === 'left') {
            $side = 'right';
        }else{
            $side = 'left';
        }
        foreach($matching_pairs as $user) {
            $find_match = MatchingPair::where('parent_id', $user->parent_id)
                                        ->where('count', $user->count)
                                        ->where('parent_position', '!=', $user->parent_position)
                                        ->where('position', $side)->first();
            if ($find_match) {
                $this->bonusSave($find_match->parent_id, $user->user_id, 'matching', $this->matching_bonus);
            }
        }

    }

    private function generationBonus ($user_id) {

        $gen_bonuses = $this->gen_bonus;
        $generations = Generation::where('member_id', $user_id)->get();
        foreach($generations as $gen) {
            switch ($gen->gen_type) {
                case 1:
                    $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[0]);
                  break;
                case 2:
                    $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[1]);
                  break;
                case 3:
                    $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[2]);
                  break;
                case 4:
                    $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[3]);
                  break;
                case 5:
                    $this->bonusSave($gen->main_id, $user_id, 'gen', $gen_bonuses[4]);
                  break;
                default:
                    $this->bonusSave($gen->parent_id, $user_id, 'gen', $gen_bonuses[5]);
              }
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
}
