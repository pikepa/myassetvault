<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Party>
 */
class PartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $biasedIdx = fake()->biasedNumberBetween(1, 6, fn ($i) => 1 - sqrt($i));
        $status = $biasedIdx < 4 ? 'paid' : fake()->randomElement(['refunded', 'failed', 'unpaid']);

        return [
            'firstname' => fake()->firstName(),
            'surname' => fake()->lastName(),
            'title' => fake()->randomElement(['mr', 'mrs', 'ms', 'dr', 'dato', 'datin']),
            'gender' => fake()->randomElement(['male', 'female']),
            'party_type' => false,
            'profession' => fake()->words(3, true),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => '+60'.fake()->unique()->numerify('#########'),
            'location' => fake()->randomElement(['sand', 'kk', 'koo', 'kud']),
            'branch' => fake()->randomElement(['sandakan', 'kota_kinabalu']),
            'mailing_addr' => fake()->words(3, true),
            'deceased' => false,
            'member_since' => Carbon::now()->subMonths(fake()->numberBetween(0, 100)),
        ];
    }
}
