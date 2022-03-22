<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $orderNo;
    public $date;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $orderNo
     */
    public function __construct(User $user, $orderNo, $date)
    {
        $this->user = $user;
        $this->orderNo = $orderNo;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.orders_receipt')
            ->subject('Order Being Processed');
    }
}
