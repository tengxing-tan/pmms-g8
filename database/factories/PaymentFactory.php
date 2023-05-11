<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_price' => $this->faker->randomFloat(2, 2, 99), 
            'payment_method' => $this->faker->randomElement(['cash', 'QRCode']),
            'paid_amount' => $this->faker->randomFloat(2, 2, 99),
            'change' => $this->faker->randomFloat(2, 2, 99)
        ];
    }
}
