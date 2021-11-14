<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => '?',
            'type' => $this->faker->randomElement(['street', 'square']),
            'road' => $this->faker->streetName(),
            'number' => $this->faker->numberBetween(1, 300),
            'postal_code' => $this->faker->postcode(),
            'locality' => $this->faker->city(),
            'province' => $this->faker->text(10),
            'country' => $this->faker->country(),
            'customer_id' => $this->faker->numberBetween(1, 50)
        ];
    }
}