<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Transaction extends Model
{
    use HasFactory;

    const DEATH = 'death';
    const GIFT  = 'gift';
    const SUB   = 'sub';
    const EDUCATION = 'education';
    const SALARY = 'salary';
    const TRANSFER = 'transfer';

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
