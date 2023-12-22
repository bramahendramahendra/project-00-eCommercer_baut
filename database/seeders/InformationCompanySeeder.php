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
            'name' => 'Company Name',
            'description' => 'Company Description',
            'image' => 'http://127.0.0.1:8000/images/logo_default.png',
            'email' => 'company-mail@example.com',
            'operating_days' => '07.00',
            'operating_hours' => '16.30',
            'phone' => '081234567890',
            'address' => 'address company',
            'city' => 'city',
            'state' => 'privince',
            'zipcode' => '123456',
            'country' => 'Indonesia',
        ])->create();
    }
}
