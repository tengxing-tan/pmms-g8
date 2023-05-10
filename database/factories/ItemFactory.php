<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => $this->faker->word(),
            'item_price' => $this->faker->randomFloat(2, 20, 99),
            'brand' => $this->faker->word(),
            'item_photo_path' => $this->faker->imageUrl(640, 480, 'cats'),
            'unit_cost' => $this->faker->randomFloat(2, 10, 20),
        ];
    }
}
