<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceStatusFactory extends Factory
{
    protected $model = \App\Models\InvoiceStatus::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Draft', 'Pending', 'Paid', 'Overdue', 'Cancelled']),
            'color' => fake()->hexColor(),
            'is_default' => false,
        ];
    }

    public function default(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_default' => true,
        ]);
    }
}
