<?php

namespace Database\Factories;

use App\Models\User;
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
        $organizerIds = User::whereHas('roles', function ($query) {
            $query->where('name', 'organizer');
        })->pluck('id');
        
        return [
            'title' => $this->faker->sentence,
            'image' => 'https://via.placeholder.com/800x400?text=Event+Image', // Assuming image is a string field and the value is a URL to an image
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'location' => $this->faker->address,
            'category_id' => rand(1, 5),
            'organizer_id' => $this->faker->randomElement($organizerIds),
            'capacity' => $this->faker->numberBetween(50, 200), // Assuming capacity is a numeric field
            'reservation_approval_mode' => $this->faker->randomElement(['automatic', 'manual']),
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
