<?php

namespace Database\Seeders;

use App\Models\TermsAndConditions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermsAndConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TermsAndConditions::factory()->state([
            'title' => 'Description'
        ])->create();
        TermsAndConditions::factory(20)->create();

    }
}
