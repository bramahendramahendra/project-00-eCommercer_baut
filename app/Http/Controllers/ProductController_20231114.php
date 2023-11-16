<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Material;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request) {
          // Ambil id material dan color dari request jika ada
        $materialIds = $request->input('material_id');
        // $materialId = 2;
        $colorIds = $request->input('color_id');
        $query = Product::query();
         // Jika material_id ada dalam request, tambahkan kondisi where
        // if ($materialId) {
        //     // $query->where('materials', function ($query) use ($materialId) {
        //         $query->where('id', $materialId);
        //     // });
        // }

        if ($materialIds) {
            $query->whereHas('materials', function ($query) use ($materialIds) {
                $query->whereIn('materials.id', $materialIds);
            });
        }

        // Jika color_id ada dalam request, tambahkan kondisi where
        if ($colorIds) {
            $query->whereHas('colors', function ($query) use ($colorId) {
                $query->whereIn('colors.id', $colorIds);
            });
        }

        $products = $query->with(['materials', 'colors'])->orderBy('updated_at', 'desc')->paginate(40);
        // $products = Product::query()->orderBy('updated_at', 'desc')->paginate(40);
        // $materials = Material::all()->orderBy('name', 'asc');
        // $colors = Color::all()->orderBy('name', 'desc');
        $materials = Material::orderBy('name', 'asc')->get(['id', 'name']);
        $colors = Color::orderBy('name', 'asc')->get(['id', 'name']);

        // dump($products);
        // dump($materials);
        // dump($colors);
        //  echo "<pre>";
        // var_dump($materials);
        // echo "<pre>";
        return view('product.index', [
            'products' => $products,
            'materials' => $materials,
            'colors' => $colors,
        ]);
    }

    public function view(Product $product) {
        // echo "<pre>";
        // var_dump($product);
        // echo "<pre>";
        // dump($product);
        return view('product.view', ['product' => $product]);        
    }
}