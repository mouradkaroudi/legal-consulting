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
    public function definition()
    {
        return [
            'national_ID' => fake()->nationalIdNumber(),
            'degree' => 'BA',
            'nationality' => 'سعودي',
            'gender' => 'male',
            'status' => 'available'
        ];
    }
}
