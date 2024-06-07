<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

use App\Models\Notification;


use App\Notifications\ContactCreated;
use App\Events\ContactFormSubmitted;
use Illuminate\Support\Facades\Log;

class ContactFormController extends Controller
{
    public function index()
    {
        $contacts = ContactForm::orderBy('id', 'desc')->get()->toArray();
        return $contacts;
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'service' => 'required',
            'object' => 'required',
            'note' => 'required',
        ]);
    
        $contactForm = new ContactForm($validatedData);
        $contactForm->save();

        event(new ContactFormSubmitted($contactForm));
        Log::info('ContactFormSubmitted event fired');
        $contactForm->notify(new ContactCreated($contactForm));
        





        return response()->json(['message' => 'Form submitted successfully', 'data' => $validatedData]);
    }
   
    public function getContactCreatedNotifications()
        {
            $notifications = Notification::where('type', 'App\Notifications\ContactCreated')->get();
            return $notifications;
        }
}