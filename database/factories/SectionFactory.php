<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['قسم المخ والاعصاب', 'قسم الجراحة', 'قسم الاطفال', 'قسم النساء والتوليد', 'قسم العيون', 'قسم الباطنة']),
            'description' => $this->faker->paragraph
        ];
    }
}
