<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bio' => fake()->realText($maxNbChars = 200),
            'date_of_birth' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'profile_pic' => fake()->imageUrl($width = 200, $height = 200, 'people'),
        ];
    }
}
