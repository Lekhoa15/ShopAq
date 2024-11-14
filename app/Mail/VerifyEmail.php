<?php
namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Xác thực địa chỉ email của bạn')
                    ->view('emails.verify-email')
                    ->with([
                        'verificationUrl' => route('verification.verify', ['id' => $this->user->id, 'hash' => sha1($this->user->email)]),
                    ]);
    }
}
