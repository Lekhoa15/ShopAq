<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordCode extends Mailable
{
    use Queueable, SerializesModels;

    public $resetCode;

    public function __construct($resetCode)
    {
        $this->resetCode = $resetCode;
    }

    public function build()
    {
        return $this->subject('Mã Xác Nhận Đổi Mật Khẩu')->view('emails.reset_password_code')->with('resetCode', $this->resetCode);
    }
}
