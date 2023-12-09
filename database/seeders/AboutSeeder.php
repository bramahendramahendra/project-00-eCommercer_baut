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
            'title' => 'Tentang Kami'
        ])->create();

        About::factory()->state([
            'title' => 'Komitmen Kami'
        ])->create();
    }
}
