<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\ImageSource;
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
        // $menu = array();
        $menu = $categories;

        $headerImage = ImageSource::whereIn('id', [1, 2, 3, 4, 5, 6, 7])->get();
        $headerImages = [];
        foreach ($headerImage as $image) {
            if ($image->image != '') {
                $headerImages[] = $image;
            } else {
                $image->image = asset('images/product_default.png');
                $headerImages[] = $image;

            }
        }
            // dump($headerImage);

        return view('layouts.app',compact('menu', 'headerImages'));
    }
}
