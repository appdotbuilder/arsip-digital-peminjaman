<?php

namespace Database\Factories;

use App\Models\Archive;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowingItem>
 */
class BorrowingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'borrowing_id' => Borrowing::factory(),
            'archive_id' => Archive::factory(),
            'status' => fake()->randomElement(['borrowed', 'returned']),
            'returned_at' => fake()->boolean(40) ? fake()->dateTimeBetween('-7 days', 'now') : null,
        ];
    }
}