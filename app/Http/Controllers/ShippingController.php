<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRequest;
use Illuminate\Http\Request;
use App\Models\User;


class ShippingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // IF USER HAS ALREADY HAVE SHIPPING ADDRESS
        if (auth()->user()->shipping()->exists()) {
            return redirect()->route('checkout.index');
        } else {
            return view('shipping.shipping');
        }
    }

    public function store(ShippingRequest $request)
    {
        auth()->user()->shipping()->create([
						'city' => $request->city,
            'street_nb' => $request->street_nb,
            'street' => $request->street,
            'additional_info' => $request->additional_info,
        ]);

        return redirect()->route('checkout.index');
    }

    public function edit()
    {
        if (is_null(auth()->user()->shipping)) return abort(404);

        return view('shipping.edit-shipping');

    }

    public function update(ShippingRequest $request)
    {
        $user = new User();
        if ($user->realUser(auth()->user()->shipping->user_id)) {
            auth()->user()->shipping()->update($request->only([
                'city',
                'street_nb',
                'street',
								'additional_info',
            ]));

            return redirect('/profiles');
        } else {
            return back();
        }

    }

}
