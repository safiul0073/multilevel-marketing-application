<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


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

    public function nominee()
    {
        return $this->belongsTo(Nominee::class);
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

    /**
     * Get the user's bonuses.
     */
    public function bonuses()
    {
        return $this->hasMany(Bonuse::class, 'given_id', 'id');
    }

    public function generations () {
        return $this->hasMany(Generation::class, 'main_id', 'id');
    }

    public function left_children () {
        return $this->belongsTo(User::class, 'left_ref_id', 'id');
    }

    public function right_children () {
        return $this->belongsTo(User::class, 'right_ref_id', 'id');
    }

    public function children () {
        return $this->hasMany(User::class, 'sponsor_id', 'id')->select(['id', 'sponsor_id', 'left_ref_id', 'right_ref_id'])->with('children');
    }

    public function epin () {
        return $this->hasOne(Epin::class, 'use_by', 'id');
    }
}
