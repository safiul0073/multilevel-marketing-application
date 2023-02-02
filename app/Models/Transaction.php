<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Transaction extends Model
{
    use HasFactory;

    const TRANSFER = 'transfer';
    const GIFT = 'gift';
    const SUBTRACT = 'sub';
    const DEATH_FOUND = 'death_found';

    protected $guarded = [];

    public function user ():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function member ():BelongsTo {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function charges ():MorphMany {

        return $this->morphMany(Charge::class, 'holder');
    }
}
