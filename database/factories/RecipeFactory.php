<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'user_id' => User::factory(),
            'category_id' => $this->faker->numberBetween(1, 7),
            'recipe_name' => $this->faker->sentence(3),
            'ingredients' => implode(', ', $this->faker->words(5)),
            'description' => $this->faker->paragraph(5),
            'image' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
