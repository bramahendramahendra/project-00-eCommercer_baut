<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_id' => fake()->numberBetween(1, 30),
            'code' => fake()->unique()->randomNumber(),
            'title' => fake()->text(50),
            'image' => fake()->imageUrl(),
            'description' => fake()->realText(190),
            'price_retail' => fake()->randomNumber(2,3,4),
            'price_wholesale' => fake()->randomNumber(2,3,4),
            'quantity_limit' => fake()->unique()->randomNumber(3),
            'unit_id' => fake()->numberBetween(1, 10),
            'material_id' => fake()->numberBetween(1, 10),
            'weight' => fake()->randomNumber(2,2,2),
            'unit_weight_id' => fake()->numberBetween(1, 10),
            'contents_per_box' => fake()->unique()->randomNumber(2),
            'unit_contents_per_box_id' => fake()->numberBetween(1, 10),
            'grade' => fake()->randomNumber(2,2,2),
            'thread_direction_id' => fake()->numberBetween(1, 10),
            'thread_density_id' => fake()->numberBetween(1, 10),
            'diameter' => fake()->randomNumber(2,2,2),
            'inner_diameter' => fake()->randomNumber(2,2,2),
            'outer_diameter' => fake()->randomNumber(2,2,2),
            'unit_diameter_id' => fake()->numberBetween(1, 10),
            'length' => fake()->randomNumber(2,2,2),
            'unit_length_id' => fake()->numberBetween(1, 10),
            'drat_size' => fake()->text(5),
            'dimensional_standart' => fake()->text(10),
            'head_style' => fake()->text(10),
            'drive_type' => fake()->text(10),
            'thick_head' => fake()->randomNumber(2,2,2),
            'unit_thick_head_id' => fake()->numberBetween(1, 10),
            'across_flats' => fake()->text(10),
            'drat_type' => fake()->text(10),
            'drat_length' => fake()->randomNumber(2,2,2),
            'unit_drat_length_id' => fake()->numberBetween(1, 10),
            'color_id' => fake()->numberBetween(1, 10),
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
