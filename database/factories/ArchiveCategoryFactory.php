<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArchiveCategory>
 */
class ArchiveCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Buku Tanah', 'code' => 'BT'],
            ['name' => 'Surat Ukur', 'code' => 'SU'],
            ['name' => 'Gambar Ukur', 'code' => 'GU'],
            ['name' => 'Warkah', 'code' => 'WR'],
        ];
        
        $category = fake()->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'code' => $category['code'] . '-' . fake()->unique()->numberBetween(1, 999),
            'description' => fake()->sentence(),
            'required_fields' => [
                'nomor' => [
                    'type' => 'text',
                    'label' => 'Nomor'
                ]
            ],
            'is_active' => true,
        ];
    }
}