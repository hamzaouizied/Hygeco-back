<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactCommercial;

class ContactCommercialController extends Controller
{
    public function index()
    {
        $contacts = ContactCommercial::orderBy('id', 'desc')->get()->toArray();
        return $contacts;
    }

    public function submitForm(Request $request)
    {
        $validatedData = $request->validate([
            'nom_entreprise' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'nom_responsable' => 'required',
            'rue' => 'required',
            'unite' => 'required',
            'ville' => 'required',
            'province' => 'required',
            'code_postal' => 'required',

        ]);

        $contactForm = new ContactCommercial($validatedData);

        $contactForm->save();

        return response()->json(['message' => 'Form submitted successfully', 'data' => $validatedData]);
    }
}
