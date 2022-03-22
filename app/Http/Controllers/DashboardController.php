<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DateTimeZone;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 0) {
            return redirect('/');
        }

        // Orders
        $orders = Order::select('transaction_no', 'created_at', 'deliveredAt')
            ->latest()
            ->whereNull('deliveredAt')
            ->get()
            ->unique('transaction_no');

        $ordersToday = Order::select('transaction_no', 'created_at', 'deliveredAt')
            ->latest()
            ->whereDate('created_at', now(new DateTimeZone('Europe/Paris')))
            ->get()
            ->unique('transaction_no');

        $earningsThisMonth = Order::whereMonth('created_at', now(new DateTimeZone('Europe/Paris'))->month)->sum('amount');

        $products = Product::count();

        $users = User::whereHas('orders', function ($query) {
            $query->whereDate('created_at', now(new DateTimeZone('Europe/Paris')));
        })->get();

        // Get the product with the most order or most selling/sales product
        $sales = Product::join('orders', 'orders.product_id', '=', 'products.id')
            ->select('orders.id', 'orders.name', 'orders.image', DB::raw("count(product_id) as sales_count"))
            ->groupBy('products.id')
            ->orderBy('sales_count', 'desc')
            ->limit(3)
            ->get();

        return view('admin.index', compact('orders', 'products', 'ordersToday', 'earningsThisMonth', 'users', 'sales'));
    }
}
