<?php

namespace Database\Factories;

use App\Enums\Assets\AssetStatus;
use App\Enums\Assets\AssetType;
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
            'asset_class' => fake()->randomElement(['Asset', 'Liability']),
            'asset_type' => fake()->randomElement(AssetType::class),
            'location' => fake()->randomElement(['AUS', 'UK', 'UAE', 'SA']),
            'qty' => fake()->numberBetween($min = 1, $max = 50),
            'acquired_value' => (fake()->numberBetween($min = 1, $max = 50) * 100),
            'status' => fake()->randomElement(AssetStatus::class),
        ];
    }
}
