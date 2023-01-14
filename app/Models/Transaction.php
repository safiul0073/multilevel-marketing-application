<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaction ():BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function member ():BelongsTo {
        return $this->belongsTo(User::class, 'member_id');
    }
}
