<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class, // Prod & dev
            AboutSeeder::class, // Prod & dev
            ImageSourceSeeder::class, // Prod & dev
            InformationCompanySeeder::class, // Prod & dev
            SocialMediaSeeder::class, // Prod & dev
            TermsAndConditionsSeeder::class, // Prod & dev
            // CategorySeeder::class, // only dev
            // ColorSeeder::class, // only dev
            // MaterialSeeder::class, // only dev
            // ThreadDensitySeeder::class, // only dev
            // ThreadDirectionSeeder::class, // only dev
            // UnitSeeder::class, // only dev
            // TypeSeeder::class, // only dev
            // ProductSeeder::class, // only dev
            // FrequentlyAskedQuestionsSeeder::class, // only dev
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
