<?php

namespace App\Models;

use App\Traits\MediaOperator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, MediaOperator;

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
            if (app()->environment('local')) {
                 $url .= ':8000';
            }
            return  $url . '/storage/'. $value;
        }
        return $value;
    }

}
