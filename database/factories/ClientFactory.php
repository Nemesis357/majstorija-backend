<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $imgArray = array(
            'img_1' => $this->faker->imageUrl($width = 640, $height = 480),
            'img_2' => $this->faker->imageUrl($width = 640, $height = 480),
            'img_3' => $this->faker->imageUrl($width = 640, $height = 480),
            'img_4' => $this->faker->imageUrl($width = 640, $height = 480),
            'img_5' => $this->faker->imageUrl($width = 640, $height = 480),
        );

        // dd(json_encode($imgArray));

        return [
            'name' => $this->faker->company(),
            'type' => $this->faker->jobTitle(),
            'short_description' => $this->faker->catchPhrase(),
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),
            'thumb_image' => $this->faker->imageUrl(640, 480),
            'ratings' => $this->faker->biasedNumberBetween($min = 1, $max = 5, $function = 'sqrt'),
            'images' => json_encode($imgArray),
        ];
    }
}
