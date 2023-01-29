<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const DIRECT = 'direct';
    const PERCENT = 'percent';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'sms_verified_at' => 'datetime',
    ];


    public function nominee():HasOne
    {
        return $this->hasOne(Nominee::class);
    }

    public function info():HasOne
    {
        return $this->hasOne(UserInfo::class, 'user_id');
    }

    /**
     * Get the user's image.
     */
    public function image()
    {
        return $this->morphOne(Media::class, 'media');
    }

    /**
     * Get the user's purchases.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function transactions ():HasMany {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the user's bonuses.
     */
    public function bonuses():HasMany
    {
        return $this->hasMany(Bonuse::class, 'given_id', 'id');
    }

    /**
     * Get the user main sponsor.
     */
    public function mainSponsor():HasOne
    {
        return $this->hasOne(Bonuse::class, 'for_given_id', 'id')->where('bonus_type', 'joining')->with('sponsor:id,username');
    }

    /**
     * Get the user's reward.
     */
    public function rewards():BelongsToMany
    {
        return $this->belongsToMany(Reward::class, 'reward_users');
    }

        /**
     * Get the user's reword user.
     */
    public function reward_users():HasMany
    {
        return $this->hasMany(RewardUser::class);
    }

    public function generations ():HasMany {
        return $this->hasMany(Generation::class, 'main_id', 'id');
    }

    public function left_children () {
        return $this->belongsTo(User::class, 'left_ref_id', 'id');
    }

    public function right_children () {
        return $this->belongsTo(User::class, 'right_ref_id', 'id')->with('right_children');
    }

    public function children ():HasMany {
        return $this->hasMany(User::class, 'sponsor_id', 'id')->select(['id', 'username', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with(['children' => fn ($q) => $q->with('image')]);
    }

    public function sponsor ():BelongsTo {
        return $this->belongsTo(User::class, 'sponsor_id');
    }

    public function epin ():HasOne {
        return $this->hasOne(Epin::class, 'use_by', 'id');
    }

    public function referrals ():HasMany {
        return $this->hasMany(Bonuse::class, 'given_id', 'id')->where('bonus_type', 'joining')->select('given_id', 'for_given_id');
    }

    public function incentiveBonusGive ():HasMany {
        return $this->hasMany(Bonuse::class, 'for_given_id');
    }

    public function generationBonusGive ():HasMany {
        return $this->hasMany(Bonuse::class, 'for_given_id');
    }

    public function withdraws ():HasMany {
        return $this->hasMany(Withdraw::class);
    }

}
