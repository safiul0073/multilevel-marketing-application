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
    public function setReferPosition (int $refferrenc_id, int $refferrer_id, string $position = 'left',):void {

        if (!in_array($position, ['left', 'right'])) {
            throw new Exception('please select left or right');
        }

        $user = User::findOrFail((int) $refferrenc_id);
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
     * @position type string between left or right.
     * @refferrenc_id type int perent id
     * @refferrer_id type int chiled id
     * @return void
     */
    public function generationLoop (string $sponser_id, string $user_id, $i) {

        $sponser = User::where('username',$sponser_id)->first();
        $sponser_sponser_id = $sponser->sponser_id;
        if ($sponser_sponser_id) {
            User::where('username', $sponser_sponser_id)->increment('total_group');
            // generation lavel creating
            Generation::create([
                'main_id' => $sponser_sponser_id,
                'member_id' => $sponser->username,
                'gen_type' => 1
            ]);

            $i = $i + 1;

            if ($i > 10) {
                return $this->generationLoop($sponser_sponser_id, $user_id, $i);
            }
        }
    }
}
