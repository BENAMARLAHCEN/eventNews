<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'spectator');
        })->get();
        $event = Event::where('status','published')->get();
        return [
            'user_id' => $user->random()->id, 
            'event_id' => $event->random()->id, 
            'reservation_code' => $this->faker->uuid,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
