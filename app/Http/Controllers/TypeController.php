<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Material;
use App\Models\Color;
use App\Http\Helpers\FilterHelper;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index(Request $request, Type $type) {
        $materialIds = json_decode($request->cookie('material_ids', '[]'), true);
        $colorIds = json_decode($request->cookie('color_ids', '[]'), true);

        // dd($type);

        $query = $type->product();
        $query = FilterHelper::applyMaterialAndColorFilters($query, $materialIds, $colorIds);
        $products = $query->orderBy('updated_at', 'desc')->paginate(40);
        
        // dd($products);
        return view('type.index', array_merge(
            ['type' => $type,'products' => $products], 
            FilterHelper::getMaterialsAndColors()
        ));
    }

    // public function view(Product $product) {
    //     return view('product.view', ['product' => $product]);
    // }

}
