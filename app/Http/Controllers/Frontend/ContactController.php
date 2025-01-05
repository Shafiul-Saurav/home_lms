<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminContactNotificationMail;

class ContactController extends Controller
{
    public function contactStore(Request $request)
    {
        // dd($request->all());
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        //Send Message to Admin
        $adminMessage = 'shafiulsaurav8@gmail.com';
        Mail::to($adminMessage)->send(new AdminContactNotificationMail($contact));

        return redirect()->back()->with('message', 'Message Sent Successfully 🙂');
    }
}
