<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];
    
    public $timestamps = false;
    /**
     * Get the parent media model (user or product).
     */
    public function media()
    {
        return $this->morphTo();
    }
}
