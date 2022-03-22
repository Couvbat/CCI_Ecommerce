<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ProfileController extends Controller
{
    public function index()
    {
        session()->forget('thankyou');

        $data = [
            'city' => '',
            'street_nb' => '',
            'street' => '',
						'additional_info' => '',
        ];

        if (auth()->user()->shipping) {
            $data['city'] = auth()->user()->shipping->city;
            $data['street_nb'] = auth()->user()->shipping->street_nb;
            $data['street'] = auth()->user()->shipping->street;
            $data['additional_info'] = auth()->user()->shipping->additional_info;
        }

        return view('user.profile.index', $data);
    }


}
