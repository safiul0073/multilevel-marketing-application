<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

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
            $product->sku = $product->generateSlug(random_int(1000000, 9999999));
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
