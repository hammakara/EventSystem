<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Venue;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $organizers = Organizer::all();
        $venues = Venue::all();
        $vendors = Vendor::all();
        $attendees = Attendee::all();

        Event::factory()->count(20)->make()->each(function ($event) use ($organizers, $venues, $vendors, $attendees) {
            $event->organizer_id = $organizers->random()->id;
            $event->venue_id = $venues->random()->id;
            $event->save();

            // Attach attendees with pivot status
            $ids = $attendees->random(rand(15, 40))->pluck('id');
            $pivot = [];
            foreach ($ids as $id) {
                $pivot[$id] = ['status' => 'registered'];
            }
            $event->attendees()->attach($pivot);

            // Attach vendors with details
            $vendorIds = $vendors->random(rand(2, 4));
            foreach ($vendorIds as $v) {
                $event->vendors()->attach($v->id, [
                    'service_details' => fake()->randomElement(['Catering','Lighting','Sound','Security','Decoration']),
                    'fee' => fake()->randomFloat(2, 300, 5000),
                ]);
            }
        });
    }
}
