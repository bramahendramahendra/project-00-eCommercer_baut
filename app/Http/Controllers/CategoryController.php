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

        // var_dump($materialIds);
        // var_dump($category);

        $query = $category->product();
        // if ($materialIds) {
        //     $query->whereIn('material_id', $materialIds);
        // }
        // if ($colorIds) {
        //     $query->whereIn('color_id', $colorIds);
        // }
        $query = FilterHelper::applyMaterialAndColorFilters($query, $materialIds, $colorIds);
        $products = $query->orderBy('updated_at', 'desc')->paginate(40);

        // $materials = Material::orderBy('name', 'asc')->get(['id', 'name']);
        // $colors = Color::orderBy('name', 'asc')->get(['id', 'name']);
        
        
        return view('category.index', array_merge([
            'category' => $category,
            'products' => $products,
            // 'materials' => $materials,
            // 'colors' => $colors,
        ], FilterHelper::getMaterialsAndColors()
        ));
    }

    public function view(Product $product) {
        return view('product.view', ['product' => $product]);
    }
}
