<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 'client_id' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
        return [
            'client_id' => Client::factory(),
            'user_id' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
            'message' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'posted_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        ];
    }
}
