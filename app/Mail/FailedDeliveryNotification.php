<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FailedDeliveryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $product;
    public $sale;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $product, $sale)
    {
        $this->user = $user;
        $this->product = $product;
        $this->sale = $sale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Failed Delivery Notification')
                    ->markdown('mails.failed');
    }
}
