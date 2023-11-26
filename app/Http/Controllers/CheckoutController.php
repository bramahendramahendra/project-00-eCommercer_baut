<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Helpers\Cart;
use App\Mail\NewOrderEmail;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(Request $request) 
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        // dd($user);
        // dump();
        // exit;

        try {
            /** @var \App\Models\Customer $customer */
            $customer = $user->customer;

            list($products, $cartItems) = Cart::getProductsAndCartItems();

            $orderItems = [];
            $totalPrice = 0;
            foreach ($products as $product) {
                $price = 0;
                $quantity = $cartItems[$product->id]['quantity'];
                if($quantity > $product->quantity_limit) {
                    $price = $product->price_wholesale; 
                } else {
                    $price = $product->price_retail;
                }
                $totalPrice += $price * $quantity;
                
                $orderItems[] = [
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $price,
                ]; 
            }

            $orderData = [
                'total_price' => $totalPrice,
                'status' => OrderStatus::Unpaid,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $order = Order::create($orderData);

            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $order->id;
                OrderItem::create($orderItem);
            }

            $paymentData = [
                'order_id' => $order->id,
                'amount' => $order->total_price,
                'status' => PaymentStatus::Pending,
                'type' => 'transfer',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $payment = Payment::create($paymentData);

            CartItem::where(['user_id' => $user->id])->delete();

            $adminUsers = User::where('is_admin', 1)->get();

            foreach ([...$adminUsers, $order->user] as $user) {
                Mail::to($user)->send(new NewOrderEmail($order, (bool)$user->is_admin));
            }

            return view('checkout.success', compact('customer'));
        }
        catch (\Exception $e) {
            return view('checkout.failure', ['message' => $e->getMessage()]);
        }

    }
}
