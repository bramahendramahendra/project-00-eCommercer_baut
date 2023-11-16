<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use App\Models\Color;
use App\Http\Resources\ProductResource;
use App\Http\Helpers\FilterHelper;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(Request $request) {
        $materialIds = json_decode($request->cookie('material_ids', '[]'), true);
        $colorIds = json_decode($request->cookie('color_ids', '[]'),true);

        $query = Product::query();
        
        // if ($materialIds) {
        //     $query->whereIn('material_id', $materialIds);
        // }
        // if ($colorIds) {
        //     $query->whereIn('color_id', $colorIds);
        // }
        $query = FilterHelper::applyMaterialAndColorFilters($query, $materialIds, $colorIds);
        // $products = ProductResource::collection($query->orderBy('updated_at', 'desc')->paginate(40));
        
        $products = $query->material()->orderBy('updated_at', 'desc')->paginate(40);
        // $materials = Material::orderBy('name', 'asc')->get(['id', 'name']);
        // $colors = Color::orderBy('name', 'asc')->get(['id', 'name']);
     
        dump($products);
        return view('product.index', array_merge(
            ['products' => $products,
            // 'materials' => $materials,
            // 'colors' => $colors,
            // FilterHelper::getMaterialsAndColors()
            ], FilterHelper::getMaterialsAndColors()
        ));
    }

    public function view(Product $product) {
        return view('product.view', ['product' => $product]);        
    }
}