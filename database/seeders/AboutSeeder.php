<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::factory()->state([
            'title' => 'Tentang Kami',
            'description' => 'Tentang Kami' // prod tidak comment, dev dicomment
        ])->create();

        About::factory()->state([
            'title' => 'Komitmen Kami',
            'description' => 'Komitmen Kami' // prod tidak comment, dev dicomment 
        ])->create();
    }
}
