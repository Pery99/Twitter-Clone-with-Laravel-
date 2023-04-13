<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tweet>
 */
class TweetsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'username' => fake()->userName(),
            'tweets' => fake()->paragraph(5),
            'likes' => fake()->randomDigit(),
            'retweets' => fake()->randomDigit(),
            'share' => fake()->randomDigit(),
            'comments'=>fake()->randomDigit(),
            
        ];
    }
}
