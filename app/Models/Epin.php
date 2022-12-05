<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function use_by () {
        return $this->belongsTo(User::class, 'use_by', 'id');
    }
}
