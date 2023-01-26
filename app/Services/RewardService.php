<?php

namespace App\Services;

use App\Models\Reward;
use App\Models\RewardUser;
use App\Models\User;

class RewardService {

    public static function checkReward($user) {

        $rewards = Reward::select('id','designation','left_count', 'right_count')->get();
        if (count($rewards)) {
            foreach($rewards as $reward) {

                if ($reward->left_count <= $user->left_group
                    &&
                    $reward->right_count <= $user->right_group){
                        RewardUser::firstOrCreate([
                            'reward_id' => $reward->id,
                            'user_id'   => $user->id,
                            'name'  => $reward->designation
                        ],
                        [
                            'status' => false
                        ]);
                    }
            }
        }
    }

    public static function checkUserForReward ($reward, $isUpdate= false) {

        $users = User::where('right_group', '>=', $reward->right_count)
                       ->where('left_group', '>=', $reward->left_count)
                       ->select('id')->get()->toArray();

        if ($isUpdate) {
            array_map(function ($user) use($reward) {
                RewardUser::updateOrCreate([
                    'reward_id' => $reward->id,
                    'user_id'   => $user['id'],
                ],
                [
                    'name'  => $reward->designation
                ]);
            }, $users);
        }else{
            $reward->reward_users()->createMany(
                array_map(function ($user) use($reward) {
                    return [
                        'user_id'   => $user['id'],
                        'name'  => $reward->designation
                    ];
                }, $users)
            );
        }

    }
}
