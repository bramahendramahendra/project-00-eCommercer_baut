<?php

namespace App\Http\Controllers;

use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Models\About;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(Request $request) {
        $abouts = About::whereIn('id', [1, 2])
            ->get();

        $totalCustomers = Customer::where('status', CustomerStatus::Active->value)->count();
        $totalProducts = Product::count();
        $totalOrders = Order::whereIn('status', [
            OrderStatus::Paid->value, 
            OrderStatus::Shipped->value, 
            OrderStatus::Completed->value
        ])->count();

        // dump($abouts);
        // dump($totalCustomer);
        // dump($totalProduct);
        // dump($totalOrders);
        return view('about.index', compact('abouts', 'totalCustomers', 'totalProducts', 'totalOrders'));
    }
}
