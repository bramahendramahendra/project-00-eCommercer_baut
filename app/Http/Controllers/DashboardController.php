<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ImageSource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $categoriesShop = Category::getShopByCategory(5)->get();
        $prodoctsTopSell = Product::getTopSellingProducts(4)->get();

        // 
        $sectionImage = ImageSource::where('id', 8)->get();
        $sectionImages = [];
        foreach ($sectionImage as $image) {
            if ($image->image != '') {
                $sectionImages[] = $image;
            } else {
                $image->image = asset('images/featured_image_default.png');
                $sectionImages[] = $image;

            }
        }

        $footerImage = ImageSource::whereIn('id', [9, 10, 11, 12, 13, 14])->get();
        $footerImages = [];
        foreach ($footerImage as $image) {
            if ($image->image != '') {
                $footerImages[] = $image;
            } else {
                $image->image = asset('images/product_default.png');
                $footerImages[] = $image;

            }
        }

        return view('dashboard', compact('categoriesShop', 'prodoctsTopSell', 'sectionImages', 'footerImages'));
    }
}
