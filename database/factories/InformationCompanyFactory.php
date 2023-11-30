<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InformationCompany>
 */
class InformationCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(10),
            'description' => $this->faker->realText(100),
            'image' => fake()->imageUrl(),
            'email' => fake()->unique()->safeEmail(),
            'operating_days' => $this->faker->text(10),
            'operating_hours' => $this->faker->text(10),
            'phone' => fake()->numberBetween(100000000000, 999999999999),
            'address' => $this->faker->text(200),
            'city' => $this->faker->text(10),
            'state' => $this->faker->text(10),
            'zipcode' => fake()->numberBetween(100000,999999),
            'country' => $this->faker->text(10),
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
