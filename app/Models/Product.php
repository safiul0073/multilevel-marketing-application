<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

    const DIRECT = 'direct';
    const PERCENT = 'percent';

    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = $product->generateSlug(generateRandomString());
        });

        static::deleting(function ($product) {
            Schema::disableForeignKeyConstraints();
        });
    }

    function generateSlug($name)
    {

        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] .'-'. + 1 . '- product' ;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }


    /**
     * Get the user's images.
     */
    public function images()
    {
        return $this->morphMany(Media::class, 'media');
    }
}
