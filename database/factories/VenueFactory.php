<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Hall',
            'address' => fake()->streetAddress() . ', ' . fake()->city(),
            'contact' => fake()->phoneNumber(),
            'owner' => fake()->name(),
            'image' => 'https://images.unsplash.com/photo-1485217988980-11786ced9454?q=80&w=800&auto=format&fit=crop',
        ];
    }
}
