<?php

namespace App\Http\Controllers;

use App\Models\Category;
// use App\Models\Type;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $categoriesShop = Category::getShopByCategory(5)->get();
        $prodoctsTopSell = Product::getTopSellingProducts(4)->get();

        // dump($categoriesShop);
        // dump($prodoctsTopSell);
        // exit;
        // foreach ($categories as $category) {
        //     if ($category->type->isNotEmpty() && $category->type->first()->product->isNotEmpty()) {
        //         // continue;
        //         dump($category->type->first()->product->first());
        //     }
        // }
        // foreach ($categories as $category) {
        //    foreach ($category->type as $type) {
        //         foreach ( $type->product as $product) {
        //             dump($product);
        //         }
        //     }
        // }
        // exit;

        return view('dashboard', compact('categoriesShop', 'prodoctsTopSell' ));
    }
}
