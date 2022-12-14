<?php

namespace App\Services;

use App\Models\Bonuse;
use App\Models\Generation;
use App\Models\MatchingPair;
use App\Models\Transaction;
use App\Models\User;
use Exception;

class UserService {

    /**
     * @position type string between left or right.
     * @refferrenc_id type int perent id
     * @refferrer_id type int chiled id
     * @return void
     */
    public function setReferPosition (int $sponsor_id, int $refferrer_id, string $position = 'left',):void {

        if (!in_array($position, ['left', 'right'])) {
            throw new Exception('please select left or right');
        }

        $user = User::find((int) $sponsor_id);
        if ($position === 'left') {
            if ($user->left_ref_id) {
                throw new Exception('Left is already fillup!');
            }else {
                $user->left_ref_id = $refferrer_id;
            }
        }else {
            if ($user->right_ref_id) {
                throw new Exception('Right is already fillup!');
            }else {
                $user->right_ref_id = $refferrer_id;
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
                        'count'     => $i,
                        'user_id'   => $user_id,
                        'position'  => $position
                    ]);
            }else{
                $sponsor_sponsor->right_group = $sponsor_sponsor->right_group + 1;
                    MatchingPair::create([
                        'parent_id' => $sponsor_sponsor->id,
                        'count'     => $i,
                        'user_id'   => $user_id,
                        'position'  => $position
                    ]);
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
     * @reneration looping from 1 - 10.
     * @$sponser_id int
     * @user_id who joined
     * $i loop index
     * @return void
     */
    public function bonusGiven ($sponser_id, $user_id, $side) {

        // first joining bonus given
        $sponser = User::find((int) $sponser_id);
        $join_bonus = config('setting_option.bonuse.joining');
        $sponser->balance = $sponser->balance + $join_bonus;
        $sponser->save();
        $sponser->bonuses()->create([
            'bonus_type' => 'joining',
            'for_given_id'=> $user_id,
            'amount'      => $join_bonus
        ]);
        $this->matchingBonus($user_id, $side);
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
                                        ->where('position', $side)->first();
            if ($find_match) {
                $this->bonusSave($find_match->parent_id, $user->user_id, 'matching', 100);
            }
        }

    }

    private function bonusSave ($sponsor_id, $user_id, $type, $amount) {
        Bonuse::create([
            'given_id'   => $sponsor_id,
            'bonus_type' => 'matching',
            'for_given_id'=> $user_id,
            'amount'      => 100
        ]);
        $sponsor = User::find((int) $sponsor_id);
        $sponsor->balance = $sponsor->balance + $amount;
        $sponsor->save();
    }
}
