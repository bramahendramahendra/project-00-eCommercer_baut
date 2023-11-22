<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Helpers\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
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

            // dd($customer);
            // exit;

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

            // Create Order
            $orderData = [
                'total_price' => $totalPrice,
                'status' => OrderStatus::Unpaid,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $order = Order::create($orderData);
            // echo '<pre>';
            // var_dump($order);
            // echo '</pre>';

            // Create Order Item 
            foreach ($orderItems as $orderItem) {
                $orderItem['order_id'] = $order->id;
                OrderItem::create($orderItem);
            }

            // Create Payment 
            $paymentData = [
                'order_id' => $order->id,
                'amount' => $order->total_price,
                'status' => PaymentStatus::Pending,
                'type' => 'transfer',
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ];
            $payment = Payment::create($paymentData);
            // echo '<pre>';
            // var_dump($payment);
            // echo '</pre>';
            // exit;

            CartItem::where(['user_id' => $user->id])->delete();

            return view('checkout.success', compact('customer'));
        }
        catch (\Exception $e) {
            return view('checkout.failure', ['message' => $e->getMessage()]);
        }

    }

        // return redirect($session->url);

    // public function success(Request $request) 
    // {
    //     dd($request->all());
    // }

    // public function failure(Request $request) 
    // {
    //     dd($request->all());
    // }
}
