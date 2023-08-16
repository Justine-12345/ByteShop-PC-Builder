<?php

namespace App\Listeners;

use App\Events\OrderStatusChange;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\ToNotifyUser;

class SendEmailToCustomer
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
     * @param  OrderStatusChange  $event
     * @return void
     */
    public function handle(OrderStatusChange $event)
    {
        //customer->users->email
        Mail::to($event->customer->email)->send(
            new ToNotifyUser($event->customer, $event->order)
        );
    }
}
