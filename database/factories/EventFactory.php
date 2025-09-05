<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucfirst(fake()->words(rand(2,4), true)),
            'type' => fake()->randomElement(['Music','Fashion','Health & Wellness','Technology','Food & Culinary','Art & Design','Outdoor & Adventure']),
            'scheduled_at' => fake()->dateTimeBetween('now', '+3 months'),
            'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=800&auto=format&fit=crop',
        ];
    }
}
