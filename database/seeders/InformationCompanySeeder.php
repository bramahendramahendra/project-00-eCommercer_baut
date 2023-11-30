<?php

namespace Database\Seeders;

use App\Models\InformationCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InformationCompany::factory()->state([
            'image' => 'http://127.0.0.1:8000/images/logo_default.png'
        ])->create();
    }
}
