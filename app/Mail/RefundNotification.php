<?php
namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RefundNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->view('emails.refund_notification')
                    ->with([
                        'paymentAmount' => $this->payment->refund_amount,
                        'paymentId' => $this->payment->id,
                    ]);
    }
}
