<?php

namespace App\Services;

use App\Models\Generation;
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
    public function generationLoop (int $sponser_id, int $user_id, $i) {

        $sponser = User::find((int) $sponser_id);
        $sponser_sponser_id = $sponser->sponsor_id;

        if ($sponser_sponser_id) {
            $sponser_sponser = User::find((int) $sponser_sponser_id);
            $sponser_sponser->total_group = $sponser_sponser->total_group + 1;
            $sponser_sponser->save();
            // generation lavel creating

            Generation::create([
                'main_id' => $sponser_sponser_id,
                'member_id' => $user_id,
                'gen_type' => $i
            ]);

            $i = $i + 1;
            if ($i <= 10) {
                return $this->generationLoop($sponser_sponser_id, $user_id, $i);
            }
        }
    }


     /**
     * @reneration looping from 1 - 10.
     * @$sponser_id int
     * @user_id who joined
     * $i loop index
     * @return void
     */
    public function bonuseGiven ($sponser_id, $user_id, $side) {

        // first joining bonuse given
        $sponser = User::find((int) $sponser_id);
        $join_bonuse = config('setting_option.bonuse.joining');
        $sponser->balance = $sponser->balance + $join_bonuse;
        $sponser->save();
        $sponser->bonuses()->create([
            'bonuse_type' => 'joining',
            'for_given_id'=> $user_id,
            'amount'      => $join_bonuse
        ]);

    }

    private function machingBonuse ($user_id, $sponser, $side) {


        if ($side == 'right') {
            if ($sponser->left_ref_id) {
                $sponser->bonuses()->create([
                    'bonuse_type' => 'maching',
                    'for_given_id'=> $user_id,
                    'amount'      => 100
                ]);
            }
        }
    }
}
