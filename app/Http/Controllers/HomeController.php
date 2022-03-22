<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart as MyCart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->forget('thankyou');

        $products = Product::with(['photos'])
            ->offset(0)
            ->limit(9)
            ->get();

				$categories = Category::all();

        return view('home', compact('products','categories'));
    }

    public function test()
    {
        return view('test');
    }

}
