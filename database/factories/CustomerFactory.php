<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fullname' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'address' => '',
            'phone' => rand(1, 999999999999),
            'gender' => 'M',
            'photo' =>''
        ];
    }
}
