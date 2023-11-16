<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use App\Models\Color;
use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{

    public function index(Request $request) {
        $materialIds = json_decode($request->cookie('material_ids', '[]'), true);
        $colorIds = json_decode($request->cookie('color_ids', '[]'),true);

        $query = Product::query();
        if ($materialIds) {
            $query->whereIn('material_id', $materialIds);
        }
        if ($colorIds) {
            $query->whereIn('color_id', $colorIds);
        }
        $products = $query->orderBy('updated_at', 'desc')->paginate(40);
        $materials = Material::orderBy('name', 'asc')->get(['id', 'name']);
        $colors = Color::orderBy('name', 'asc')->get(['id', 'name']);
     
        return view('product.index', [
            'products' => $products,
            'materials' => $materials,
            'colors' => $colors,
        ]);
    }

    //  public function filter(Request $request) {
    //     $materialIds = json_decode($request->cookie('material_ids', '[]'), true);
    //     $colorIds = json_decode($request->cookie('color_ids', '[]'),true);

    //     $query = Product::query();
    //     if ($materialIds) {
    //         $query->whereIn('material_id', $materialIds);
    //     }
    //     if ($colorIds) {
    //         $query->whereIn('color_id', $colorIds);
    //     }
    //     $products = $query->orderBy('updated_at', 'desc')->paginate(40);
    //     $materials = Material::orderBy('name', 'asc')->get(['id', 'name']);
    //     $colors = Color::orderBy('name', 'asc')->get(['id', 'name']);
     
    //     return view('product.index', [
    //         'products' => $products,
    //         'materials' => $materials,
    //         'colors' => $colors,
    //     ]);
    // }

    

    public function view(Product $product) {
        return view('product.view', ['product' => $product]);        
    }
}