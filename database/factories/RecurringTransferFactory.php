<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RecurringTransaction>
 */
class RecurringTransferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => $this->faker->dateTimeBetween(now()->addDay(), now()->addMonth()),
            'end_date' => $this->faker->dateTimeBetween(now()->addMonth()->addDay(), now()->addMonths(8)),
            'frequency' => $this->faker->numberBetween(1, 10),
            'recipient_email' => $this->faker->email(),
            'amount' => $this->faker->numberBetween(1000, 100000),
            'reason' => $this->faker->words(2, true),
        ];
    }
}
