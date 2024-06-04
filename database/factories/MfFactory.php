<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mf>
 */
class MfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mang = ['Toyota', 'Honda', 'Ford', 'Mazda', 'BMW', 'Vinfat'];
        $mfName = fake()->unique()->randomElement($mang);
        return [
            'mf_name' => $mfName,
        ];
    }
}
