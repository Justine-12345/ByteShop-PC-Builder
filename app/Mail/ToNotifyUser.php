<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ToNotifyUser extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $order)
    {
        //
        $this->customer = $customer;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email_for_customer')
                    ->subject('Byte Shop Order Status');
    }
}
