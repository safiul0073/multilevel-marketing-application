<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function image ():MorphOne {
        return $this->morphOne(Media::class, 'media');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($blog) {
            $blog->slug = $blog->generateSlug(generateRandomString());
        });
    }

    function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] .'-'. + 1 . '- news' ;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }
}
