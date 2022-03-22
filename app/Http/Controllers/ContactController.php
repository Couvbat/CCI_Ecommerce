<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  function view()
	{
		return view('contact');
	}

	function store(ContactRequest $request)
	{
		Contact::create([
			'email' => $request->input('email'),
			'object' => $request->input('object'),
			'msg' => $request->input('msg')
		]);

		return redirect('/');
	}
}
