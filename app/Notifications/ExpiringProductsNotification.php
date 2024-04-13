<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Inventory; // Import the Inventory model

class ExpiringProductsNotification extends Notification
{
    use Queueable;

    protected $products;

    /**
     * Create a new notification instance.
     *
     * @param \Illuminate\Database\Eloquent\Collection $products
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Expiring Products Notification')
            ->line('The following products are expiring soon:')
            ->line($this->products->implode('name', ', '))
            ->action('View Inventory', route('inventory.index'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Retrieve the expiring products for notification.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function expiringProducts()
    {
        return Inventory::where('expiration', '<=', now()->addWeek())
                        ->where('expiration', '>=', now())
                        ->get();
    }
}
