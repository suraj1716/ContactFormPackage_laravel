<?php
namespace Suraj1716\Contactform\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;
use Suraj1716\Contactform\Mail\InquiryEmail;
use Suraj1716\Contactform\Models\Contact;

class ContactFormController extends BaseController
{

    public function create()
    {
        return view('contactform::create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required',

        ]);


        Contact::create($validated);

        $admin_email=\config('contactform.admin_email');

        if($admin_email===null || $admin_email===''){
            echo'the value of admin email not set';
        } else
{
    Mail::to($admin_email)->send(new InquiryEmail($validated));
}

       return back()->with('success','Inquiry Sent Succefully');
    }
}
