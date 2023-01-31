<?php

namespace App\Listeners;

use App\Events\PurchaseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PurchaseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PurchaseEvent  $event
     * @return void
     */
    public function handle(PurchaseEvent $event)
    {
        $user = $event->user;
        $product = $event->product;

        $user->purchases()->create([
            'product_id'    => $product->id,
            'amount'        => $product->price,
            'status'        => $product->is_package, // is_package getting value 1 or 0 and status will be 1 purchased and 0 pending
            'type'          => $product->is_package,
        ]);
    }
}
