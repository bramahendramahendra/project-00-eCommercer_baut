<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $orders = Order::query()
            ->where(['created_by' => $user->id])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // dump($orders);
        return view('order.index', compact('orders'));
    }
}
