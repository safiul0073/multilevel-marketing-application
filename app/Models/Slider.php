<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image():MorphOne
    {
        return $this->morphOne(Media::class, 'media')->where('type', Media::SLIDER);
    }

    public function images():MorphMany
    {
        return $this->morphMany(Media::class, 'media')->where('type', Media::GALLERY);
    }
}
