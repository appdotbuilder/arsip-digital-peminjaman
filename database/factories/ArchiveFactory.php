<?php

namespace Database\Factories;

use App\Models\ArchiveCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archive>
 */
class ArchiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'archive_category_id' => ArchiveCategory::factory(),
            'title' => fake()->sentence(3),
            'archive_number' => fake()->unique()->regexify('[A-Z]{2}-[0-9]{4}-[0-9]{4}'),
            'archive_data' => [
                'nomor' => fake()->regexify('[0-9]{3}/[0-9]{4}'),
            ],
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['available', 'borrowed']),
        ];
    }
}