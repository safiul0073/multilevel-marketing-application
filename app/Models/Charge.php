<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    const TRANSFER = 'transfer';
    const WITHDRAW = 'withdraw';

    protected $guarded = [];

        /**
     * Get the parent media model (withdraw or transaction).
     */
    public function holder()
    {
        return $this->morphTo()->with('user:id,username');
    }
}
