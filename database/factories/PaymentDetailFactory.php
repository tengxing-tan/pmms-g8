<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_id' => $this->faker->numberBetween(1, 10), // 'payment_id' is a foreign key to 'id' in 'payments' table
            'id' => $this->faker->numberBetween(1, 10), // 'id' is a foreign key to 'id' in 'items' table
            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}
