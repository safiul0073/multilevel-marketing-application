<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the nominee's image.
     */
    public function image()
    {
        return $this->morphOne(Media::class, 'media');
    }
}
