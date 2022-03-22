<?php

namespace App\Http\Controllers;


use App\Mail\OrderReceipt;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe;
use Illuminate\Support\Carbon;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->shipping()->doesntExist() && Cart::instance('default')->count() != 0) {
            return redirect()->route('shipping.index');
        } elseif (Cart::instance('default')->count() == 0 && auth()->user()->shipping()->exists()) {
            return redirect()->route('home');
        }

        $total = str_replace(array(','), '', Cart::total());
        $config = config("api.PAYPAL_CLIENT_ID");

        $city = auth()->user()->shipping->city;
				$street_nb = auth()->user()->shipping->street_nb;
				$street = auth()->user()->shipping->street;
				$additional_info = auth()->user()->shipping->additional_info;

        return view('checkout.checkout', [
            "PAYPAL_CLIENT_ID" => $config,
            "total" => $total,
            'city' => $city,
            'street_nb' => $street_nb,
            'street' => $street,
            'additional_info' => $additional_info,
        ]);
    }

    public function thankyou(Order $order)
    {
        if (!session()->has('thankyou')) {
            return redirect()->route('home');
        }

        $user = User::with('orders')->findOrFail(auth()->user()->id)->first();


        return view('thankyou', [
            'user' => $user
        ]);
    }

    public function store(Request $request, Order $order, Product $product)
    {
        // Check for Paypal Request from Axios
        if ($data = $request->paypal) {

            $details = session(["paypal" => $data]);

            $value = session('paypal');

            $this->paypalIntegration($request, $value, $order, $product);

            return response()->json([
                "success" => true
            ]);
        }
    }

    protected function paypalIntegration($request, $details, Order $order, Product $product)
    {
        try {
            $content = Cart::content();

            $date = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $details['create_time'], 'Europe/Paris');

            $isPaid = $date->toDateTimeString();

            $tax = intval(str_replace(array(','), '', Cart::tax()));

            $data = [
                'content' => $content,
                'id' => $details["id"],
                'isPaid' => $isPaid,
                'tax' => $tax
            ];

            // Save Order to the database
            $order->saveOrder($data);

            $product->updateProductQuantity($data);

            // Remove All Cart
            Cart::instance('default')->destroy();

            // Delete the saved cart from the  database
            Cart::instance('default')->erase(auth()->user()->id);

            session(["thankyou" => $data['id']]); // Create session for Order #

            // Remove Paypal Details
            session()->forget('paypal');

            // SEND EMAIL
            $orderNo = session('thankyou');
            $date = now(new DateTimeZone('Europe/Paris'))->toDayDateTimeString();

            Mail::to(auth()->user()->email)->send(new OrderReceipt(auth()->user(), $orderNo, $date));

            //\Illuminate\Database\QueryException

        } catch (Exception $e) {
            return back()->with('Error! ' . $e->getMessage());
        }
    }


    public function generateRandomString($length = 15)
    {

        $characters = '012345678901234567890123456789012345678901234567890123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $transationnoDoesExist = Order::find($randomString);

        $check = (!$transationnoDoesExist) ? $randomString : $this->generateRandomString();

        return $check;
    }
}
