<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendee>
 */
class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'status' => fake()->randomElement(['active','vip','guest']),
            'preferences' => [
                'categories' => fake()->randomElements([
                    'Music','Technology','Fashion','Art & Design','Food & Culinary','Outdoor & Adventure','Health & Wellness'
                ], rand(1,3)),
            ],
            'image' => 'https://i.pravatar.cc/150?img=' . rand(1,70),
        ];
    }
}
