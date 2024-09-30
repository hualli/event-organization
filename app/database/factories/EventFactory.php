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
            'title' => $this->faker->sentence(3),
            'short_description' => $this->faker->text(100),
            'long_description' => $this->faker->text(250),
            'date_time' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'organizer' => $this->faker->company(),
            'location' => $this->faker->address(),
            'status' => $this->faker->randomElement(['borrador', 'publicado'])
        ];
    }
}
