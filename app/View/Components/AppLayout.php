<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $categories = Category::whereHas('type.product')->with('type.product')->get();
        foreach ($categories as $category) {
            foreach ($category->type as $type) {
                $type->setRelation('product', $type->product->take(1));
            }
        }
        return view('layouts.app',['menu' => $categories]);
    }
}
