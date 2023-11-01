<?php

namespace Database\Seeders;

use App\Models\ThreadDirection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadDirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ThreadDirection::factory(30)->create();
    }
}
