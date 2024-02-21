<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(2,User::count()),
            'content' => fake()->realText($maxNbChars = 200),
            'title' => fake()->catchPhrase($maxNbChars = 10),
            'post_pic' => fake()->imageUrl($width = 200, $height = 200, 'food'),
        ];
    }
}
