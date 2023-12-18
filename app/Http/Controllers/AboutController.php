<?php

namespace App\Http\Controllers;

use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Models\About;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\ImageSource;
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

        $aboutHeaderImage = ImageSource::whereIn('id', [15, 16, 17, 18, 19])->get();
        $aboutHeaderImages = [];
        foreach ($aboutHeaderImage as $image) {
            if ($image->image != '') {
                $aboutHeaderImages[] = $image;
            } else {
                $image->image = asset('images/product_default.png');
                $aboutHeaderImages[] = $image;

            }
        }

        $aboutFooterImage = ImageSource::where('id', 20)->get();
        $aboutFooterImages = [];
        foreach ($aboutFooterImage as $image) {
            if ($image->image != '') {
                $aboutFooterImages[] = $image;
            } else {
                $image->image = asset('images/featured_image_default.png');
                $aboutFooterImages[] = $image;
            }
        }

        return view('about.index', compact('abouts', 'totalCustomers', 'totalProducts', 'totalOrders', 'aboutHeaderImages', 'aboutFooterImages'));
    }
}
