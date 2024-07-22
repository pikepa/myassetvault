<?php

namespace Database\Factories;

use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Models\Asset;
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
            'transaction_date' => Carbon::now()->subDays(fake()->numberBetween(0, 100)),
            'document_ref' => 10000 + fake()->numberBetween(0, 500),
            'asset_id' => Asset::inRandomOrder()->first()->id,
            'year' => fake()->randomElement(Year::class),
            'month' => fake()->randomElement(Month::class),
            'current_value' => fake()->numberBetween(10000, 100000),
            'status' => fake()->randomElement(['paid', 'unpaid', 'failed', 'refunded']),
            'comments' => fake()->sentence(),
        ];
    }
}
