<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\Color;
use App\Helpers\FilterHelper;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request, Category $category) {
        $materialIds = json_decode($request->cookie('material_ids', '[]'), true);
        $colorIds = json_decode($request->cookie('color_ids', '[]'), true);

        $query = $category->product();
        $query = FilterHelper::applyMaterialAndColorFilters($query, $materialIds, $colorIds);
        $products = $query->orderBy('updated_at', 'desc')->paginate(40);

        return view('category.index', array_merge([
            'category' => $category,
            'products' => $products,
        ], FilterHelper::getMaterialsAndColors()
        ));
    }

    public function view(Product $product) {
        return view('product.view', ['product' => $product]);
    }
}
