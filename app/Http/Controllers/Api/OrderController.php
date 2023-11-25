<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderListResource;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Order::query()
            ->where('id', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);
        
        return OrderListResource::collection($query);
    }

    public function view(Order $order) 
    {
        return new OrderResource($order);   
    }

    public function getStatuses() 
    {
        return OrderStatus::getStatuses();
    }

    public function changeStatus(Order $order, $status) 
    {
        // echo "<pre>";
        // var_dump($order);
        // var_dump($status);
        // echo "</pre>";
        $order->status = $status;
        $order->save();
        return response('', 200);


        //  try {
        //     $order->status = $status;
        //     $order->save();
        //     return response()->json(['message' => 'Status updated successfully'], 200);
        // } catch (\Exception $e) {
        //     // Log the exception for debugging
        //     \Log::error($e->getMessage());
        //     // Return a 500 error with the exception message
        //     return response()->json(['message' => 'Server Error: ' . $e->getMessage()], 500);
        // }
    }
}