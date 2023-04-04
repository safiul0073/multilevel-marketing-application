<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index () {

        return view('frontend.contents.contact.index');
    }

    public function store (Request $request) {


        $this->validate($request, [
            'email'     => 'required|email',
            'subject'   => 'required|string',
            'message'   => 'required|string|max:500'
        ]);

        Contact::create($request->all());

        return redirect()->back()->with(['success' => 'Message sended.']);
    }
}
