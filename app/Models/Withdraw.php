<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user ():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function charges ():MorphMany {

        return $this->morphMany(Charge::class, 'holder');
    }
}
