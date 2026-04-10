<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->numberBetween(1000, 10000);
        $tax = round($subtotal * 0.1, 2);

        return [
            'client_id' => Client::inRandomOrder()->value('id'),
            'project_id' => Project::inRandomOrder()->value('id'),
            'invoice_number' => null,
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(14)->toDateString(),
            'status' => fake()->randomElement(['draft', 'sent', 'paid']),
            'line_items' => [['name' => 'Service Retainer', 'qty' => 1, 'price' => $subtotal]],
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $subtotal + $tax,
            'notes' => 'Auto-generated sample invoice',
        ];
    }
}
