<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'family_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'genre' => $this->faker->numberBetween(0, 1),
            'phone' => $this->faker->phoneNumber(),
            'status' => $this->faker->numberBetween(0, 1),
            'user_id' => $this->faker->random_int(1)
        ];
    }
}