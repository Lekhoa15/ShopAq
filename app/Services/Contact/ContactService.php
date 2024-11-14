<?php

namespace App\Services\Contact;

use App\Mail\ContactFormSubmission;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    public function saveContactData($data)
    {

        return Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'message' => $data['message'],
            'subject' => $data['subject'] ?? 'No subject',
        ]);
    }

    public function sendConfirmationEmail($contact)
    {
        // Gửi email xác nhận
        Mail::to($contact->email)->send(new ContactFormSubmission($contact));
    }
}
