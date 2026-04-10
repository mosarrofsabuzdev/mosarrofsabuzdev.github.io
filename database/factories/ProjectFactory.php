<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->value('id'),
            'name' => fake()->bs(),
            'status' => fake()->randomElement(['active', 'paused', 'completed']),
            'start_date' => now()->subMonths(1)->toDateString(),
            'end_date' => now()->addMonths(3)->toDateString(),
            'budget' => fake()->numberBetween(5000, 35000),
            'phases' => ['Discovery', 'Execution', 'QA'],
            'milestones' => [['name' => 'Kickoff', 'date' => now()->toDateString()]],
        ];
    }
}
