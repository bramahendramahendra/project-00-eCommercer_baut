<?php

namespace Database\Seeders;

use App\Models\FrequentlyAskedQuestions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FrequentlyAskedQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FrequentlyAskedQuestions::factory(10)->create();
    }
}
