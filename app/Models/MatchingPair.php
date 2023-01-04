<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchingPair extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function matchMain ():BelongsTo {
        return $this->belongsTo(User::class, 'parent_id', 'id');
    }
}
