<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_name' => fake()->company(),
            'contact_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'onboarding', 'at_risk']),
            'health_score' => fake()->numberBetween(2, 5),
            'mrr' => fake()->numberBetween(800, 6000),
            'renewal_date' => now()->addMonths(fake()->numberBetween(1, 10))->toDateString(),
            'account_manager_id' => User::inRandomOrder()->value('id'),
        ];
    }
}
