<?php

namespace Database\Factories;

use App\Enums\Priority;
use App\Enums\TicketStatus;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'title' => fake()->text(20),
            'description' => fake()->paragraph(9),
            'priority' => fake()->randomElement(Priority::cases()),
            'role' => fake()->randomElement(UserRole::cases()),
            'status' => fake()->randomElement(TicketStatus::cases()),
            'resolved' => fake()->boolean(),
            'created_at' => fake()->dateTime()
        ];
    }
}
