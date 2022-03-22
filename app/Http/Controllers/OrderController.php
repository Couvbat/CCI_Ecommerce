<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	// Orders in table
	public function index()
	{
		$this->authorize('view', auth()->user());
		$orders = Order::select('transaction_no', 'created_at', 'deliveredAt')
			->latest()
			->get()
			->unique('transaction_no');

		return view('admin.orders', compact('orders'));
	}

	// Authenticated User's Order
	public function myOrders()
	{
		session()->forget('thankyou');

		$authenticated_user_id = (int)auth()->user()->id;

		$order = Order::select('transaction_no', 'created_at', 'isPaid', 'deliveredAt')
			->where('user_id', $authenticated_user_id)
			->latest()
			->get()
			->unique('transaction_no');

		return view('user.order', compact('order'));
	}

	// Single Order
	public function show($id)
	{
		// Select All ORDERS WITH PRODUCTS OF THE AUTHENTICATED USER BY TRANSACTION NO
		$orders = Order::where('transaction_no', $id)->get();

		// SUM OF EACH AMOUNT WITH THE ALL THE SAME CORRECT TRANSACTION_NO
		//$total = $orders->sum('amount');

		$total = 0;
		$itemsCount = 0;

		foreach ($orders as $key => $order) {
			$itemsCount += $order->qty;
			$total += $order->amount * $order->qty;
		}

		// Get the Tax
		$tax = Order::where('transaction_no', $id)->first()->tax;

		// Check If Delivered
		$isDelivered = Order::where('transaction_no', $id)->first()->deliveredAt;

		$date = Carbon::parse($isDelivered)->toDayDateTimeString();

		$user = User::with(['shipping'])->findOrFail($orders[0]->user_id);

		$shippingAddress = $user->shipping()->first();

		$selectedProvince = DB::table('refprovince')
			->where('provCode', $shippingAddress->province)
			->first();

		$selectedCity = DB::table('refcitymun')
			->where('citymunCode', $shippingAddress->city)
			->first();

		$userOwnedTheOrder = DB::table('orders')
			->where('user_id', auth()->user()->id)
			->where('transaction_no', $id)
			->exists();

		// Cache the data
		$orderId = Cache::remember(
			'orderId' . auth()->user()->id,
			now()->addSeconds(30),
			function () use ($id) {
				return $id;
			}
		);

		$deliveredAt = Cache::remember(
			'orderDeliveredAt' . auth()->user()->id,
			now()->addSeconds(30),
			function () use ($date) {
				return $date;
			}
		);

		$orderTotal = Cache::remember(
			'orderTotal' . auth()->user()->id,
			now()->addSeconds(30),
			function () use ($total) {
				return $total;
			}
		);

		$orderTax = Cache::remember(
			'orderTax' . auth()->user()->id,
			now()->addSeconds(30),
			function () use ($tax) {
				return $tax;
			}
		);

		$itemsCount = Cache::remember(
			'itemsCount' . auth()->user()->id,
			now()->addSeconds(30),
			function () use ($itemsCount) {
				return $itemsCount;
			}
		);

		// If Admin
		if (auth()->user()->role === 0) {
			return view('user.show_order', [
				'id' => $id,
				'orders' => $orders,
				'itemsCount' => $itemsCount,
				'total' => $orderTotal,
				'tax' => $orderTax,
				'isDelivered' => $isDelivered,
				'deliveredAt' => $date,
				'user' => $user,
				'shippingAddress' => $shippingAddress,
				'selectedProvince' => $selectedProvince,
				'selectedCity' => $selectedCity,
			]);
		} else {
			if (!$userOwnedTheOrder) return abort(404);

			return view('user.show_order', [
				'id' => $id,
				'orders' => $orders,
				'itemsCount' => $itemsCount,
				'total' => $orderTotal,
				'tax' => $orderTax,
				'isDelivered' => $isDelivered,
				'deliveredAt' => $date,
				'user' => $user,
				'shippingAddress' => $shippingAddress,
				'selectedProvince' => $selectedProvince,
				'selectedCity' => $selectedCity,
			]);
		}
	}

	public function update($id)
	{
		$this->authorize('update', auth()->user());
		$orders = Order::where('transaction_no', $id)->get();

		try {
			foreach ($orders as $key => $value) {

				$order = Order::findOrFail($value->id);

				$order->update([
					'deliveredAt' => now()
				]);
			}
		} catch (\Illuminate\Database\QueryException $e) {
			die('Quelquechose c\'est mal passé ' . $e->getMessage());
		}

		return redirect()->back();
	}
}
