<?php

namespace Database\Factories;

use App\Enums\Assets\AssetStatus;
use App\Enums\Assets\AssetType;
use App\Enums\Assets\Location;
use App\Enums\Common\Month;
use App\Enums\Common\Year;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(2),
            'user_id' => User::factory()->create(),
            'asset_type' => fake()->randomElement(AssetType::class),
            'location' => fake()->randomElement(Location::class),
            'acquired_year' => fake()->randomElement(Year::class),
            'acquired_month' => fake()->randomElement(Month::class),
            'qty' => fake()->numberBetween($min = 1, $max = 50),
            'acquired_value' => (fake()->numberBetween($min = 1, $max = 50) * 100),
            'status' => fake()->randomElement(AssetStatus::class),
        ];
    }
}
