<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonuse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bonuseGot () {
        return $this->belongsTo(User::class, 'given_id', 'id');
    }
}
