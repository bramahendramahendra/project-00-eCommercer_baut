<?php

namespace Database\Seeders;

use App\Models\ImageSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 1',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 2',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 3',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 4',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 5',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 6',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Header Image 7',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Image',
            'image' => 'http://127.0.0.1:8000/images/featured_image_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 1',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 2',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 3',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 4',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 5',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer Image 6',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

         ImageSource::factory()->state([
            'name' => 'About Header Image 1',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'About Header Image 2',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'About Header Image 3',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'About Header Image 4',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'About Header Image 5',
            'image' => 'http://127.0.0.1:8000/images/product_default.png'
        ])->create();

        ImageSource::factory()->state([
            'name' => 'Dashboard Footer',
            'image' => 'http://127.0.0.1:8000/images/featured_image_default.png'
        ])->create();
    }
}
