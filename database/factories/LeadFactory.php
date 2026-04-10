<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'source' => fake()->randomElement(['organic', 'referral', 'linkedin', 'cold outreach']),
            'stage' => fake()->randomElement(['new', 'qualified', 'proposal']),
            'deal_size' => fake()->numberBetween(1000, 25000),
            'company' => fake()->company(),
            'contact_name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'assigned_to' => User::inRandomOrder()->value('id'),
            'follow_up_date' => now()->addDays(fake()->numberBetween(1, 14))->toDateString(),
            'notes' => fake()->sentence(),
        ];
    }
}
