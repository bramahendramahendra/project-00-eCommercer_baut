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
            AdminUserSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            MaterialSeeder::class,
            ThreadDensitySeeder::class,
            ThreadDirectionSeeder::class,
            UnitSeeder::class,
            TypeSeeder::class,
            ProductSeeder::class,
            AboutSeeder::class,
            FrequentlyAskedQuestionsSeeder::class,
            ImageSourceSeeder::class,
            InformationCompanySeeder::class,
            SocialMediaSeeder::class,
            TermsAndConditionsSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
