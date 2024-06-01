<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;


class ContactFormController extends Controller
{

    public function index()
    {
        $contacts = ContactForm::get()->toArray();
        return $contacts;
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'service' => 'required',
            'note' => 'required',
        ]);

        $contactForm = new ContactForm($validatedData);

        $contactForm->save();

        return response()->json(['message' => 'Form submitted successfully', 'data' => $validatedData]);
    }
}
