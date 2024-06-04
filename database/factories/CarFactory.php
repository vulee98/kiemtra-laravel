<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $imageNumber = mt_rand(1, 5);

        // Tạo tên file ảnh từ số ngẫu nhiên và thư mục
        $imageName = "images/xe{$imageNumber}.jpeg"; // Đảm bảo đuôi file phù hợp với định dạng ảnh bạn sử dụng

        return [
            'image' => 'xe'.rand(1,5).'.jpeg',
            'description' => $this->faker->asciify('user-****'),
            'model' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'produced_on' => now(),
            'mf_id'=>rand(1,6),
        ];
    }
}