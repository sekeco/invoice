<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 100, 10000);
        $taxRate = fake()->randomFloat(2, 0, 0.2);
        $discountAmount = fake()->randomFloat(2, 0, $subtotal * 0.1);
        $taxAmount = $subtotal * $taxRate;
        $totalAmount = $subtotal + $taxAmount - $discountAmount;

        return [
            'invoice_number' => fake()->unique()->numerify('INV-######'),
            'client_name' => fake()->company(),
            'client_email' => fake()->companyEmail(),
            'client_address' => fake()->address(),
            'client_phone' => fake()->phoneNumber(),
            'currency' => fake()->randomElement(['USD', 'EUR', 'GBP']),
            'issue_date' => fake()->dateTimeBetween('-30 days', 'now'),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
            'notes' => fake()->optional()->paragraph(),
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'discount_amount' => $discountAmount,
            'total_amount' => $totalAmount,
            'paid_at' => fake()->optional()->dateTimeBetween('-30 days', 'now'),
        ];
    }

    public function configure(): static
    {
        return $this->afterMaking(function (Invoice $invoice) {
            //
        })->afterCreating(function (Invoice $invoice) {
            $itemCount = fake()->numberBetween(1, 5);
            for ($i = 0; $i < $itemCount; $i++) {
                $invoice->items()->create([
                    'description' => fake()->sentence(),
                    'quantity' => fake()->randomFloat(2, 1, 10),
                    'unit_price' => fake()->randomFloat(2, 10, 1000),
                    'total_price' => fake()->randomFloat(2, 10, 1000),
                ]);
            }
        });
    }
}
