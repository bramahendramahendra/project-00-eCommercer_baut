<?php

namespace Database\Seeders;

use App\Models\ThreadDensity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadDensitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThreadDensity::factory(10)->create();
    }
}
