<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Services\Contact\ContactService;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        return view('shop.contact');
    }

    public function sendContact(ContactRequest $request)
    {


        try {

            $contact = $this->contactService->saveContactData($request->all());


            // Send confirmation email
            $this->contactService->sendConfirmationEmail($contact);


        } catch (\Exception $e) {

            return back()->withErrors('There was an error submitting the form.');
        }

        return redirect()->route('thankyou');
    }
}
