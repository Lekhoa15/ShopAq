<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Tạo một instance mới của mailable.
     *
     * @param $contact
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Xây dựng nội dung email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_form_submission')
                    ->with('contact', $this->contact);
    }
}
