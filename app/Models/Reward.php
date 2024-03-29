<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reward_users ():HasMany {
        return $this->hasMany(RewardUser::class);
    }

        /**
     * Get the user's images.
     */
    public function images()
    {
        return $this->morphMany(Media::class, 'media');
    }
}
