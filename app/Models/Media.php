<?php

namespace App\Models;

use App\Traits\MediaOperator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, MediaOperator;

    const GALLERY = 'origin_gallery';
    const SLIDER  = 'slider';
    const REWARD  = 'reward';
    const PRODUCT_GALLERY = 'gellary';
    const PRODUCT_THAMNAIL = 'thamnail';
    const PROFILE = 'profile';
    const BLOG = 'blog';
    const LOGO = 'logo';

    public $timestamps = false;

    protected $guarded = [];

    /**
     * Get the parent media model (user or product).
     */
    public function media()
    {
        return $this->morphTo();
    }

    function getUrlAttribute($value) {
        if ($value && request()->method() === 'GET') {
            $url = config('app.url');
            return  $url . '/storage/'. $value;
        }
        return $value;
    }

}
