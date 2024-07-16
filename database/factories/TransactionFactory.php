<?php

namespace Database\Factories;

use App\Enums\Transactions\Membership;
use App\Models\Party;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'party_id' => Party::factory()->create()->id,
            'transaction_date' => Carbon::now()->subDays(fake()->numberBetween(0, 100)),
            'document_ref' => 10000 + fake()->numberBetween(0, 500),
            'year' => fake()->randomElement(['2023', '2024', '2022', '2021']),
            'membership_type' => fake()->randomElement(Membership::class),
            'amount' => 5000,
            'status' => fake()->randomElement(['paid', 'unpaid', 'failed', 'refunded']),
            'comments' => fake()->sentence(),
        ];
    }
}
