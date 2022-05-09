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
    public function definition()
    {
        $users = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'owner_id' => $this->faker->randomElement($users),
            'location' => $this->faker->address(),
            'date' => $this->faker->date(),
        ];
    }
}
