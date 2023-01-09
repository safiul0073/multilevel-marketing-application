<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bonuse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bonus_got ():BelongsTo {
        return $this->belongsTo(User::class, 'given_id', 'id');
    }

    public function bonus_for ():BelongsTo {
        return $this->belongsTo(User::class, 'for_given_id', 'id');
    }

}
