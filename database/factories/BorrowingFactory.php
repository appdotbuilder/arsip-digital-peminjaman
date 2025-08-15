<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $district = District::factory();
        $village = Village::factory(['district_id' => $district]);
        $borrowDate = fake()->dateTimeBetween('-30 days', 'now');
        $returnDate = fake()->dateTimeBetween($borrowDate, '+30 days');
        
        return [
            'borrowing_number' => fake()->unique()->regexify('BRW[0-9]{8}[0-9]{4}'),
            'borrower_id' => User::factory()->state(['role' => 'employee']),
            'borrower_name' => fake()->name(),
            'borrower_photo' => null,
            'district_id' => $district,
            'village_id' => $village,
            'borrow_date' => $borrowDate,
            'return_date' => $returnDate,
            'actual_return_date' => fake()->boolean(30) ? fake()->dateTimeBetween($borrowDate, '+45 days') : null,
            'status' => fake()->randomElement(['pending', 'approved', 'borrowed', 'partially_returned', 'returned', 'overdue']),
            'notes' => fake()->optional()->sentence(),
            'approved_by' => fake()->boolean(70) ? User::factory()->state(['role' => 'officer']) : null,
            'approved_at' => fake()->boolean(70) ? fake()->dateTimeBetween($borrowDate, 'now') : null,
        ];
    }
}