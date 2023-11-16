<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('type.product')->with('type.product')->get();

        foreach ($categories as $category) {
            foreach ($category->type as $type) {
                $type->setRelation('product', $type->product->take(1));
            }
        }

        return response()->json($categories);
    }
}
