<?php

namespace App\Services;

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
    public function generationLoop (int $refferrenc_id, int $user_id, $i):void {

        
    }
}
