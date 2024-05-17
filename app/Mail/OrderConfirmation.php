<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $sanphamString;

    /**
     * Create a new message instance.
     *
     * @param  mixed  $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
       
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Confirmation')
            ->view('emails.order_confirmation')
          ;
    }
}
