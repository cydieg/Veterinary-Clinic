<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderProcessed extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $totalPrice;

    public function __construct($cart, $totalPrice)
    {
        $this->cart = $cart;
        $this->totalPrice = $totalPrice;
    }

    public function build()
    {
        return $this->view('mails.order_processed')
                    ->subject('Order Processed');
    }
}
