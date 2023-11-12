<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::query()->orderBy('updated_at', 'desc')->paginate(5);
        
        return view('category.index', [
            'categories' => $categories
        ]);
    }
}
