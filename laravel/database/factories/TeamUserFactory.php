<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamUser>
 */
class TeamUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $maxTeamId = Team::max('id');
        $maxUserId = User::max('id');

        return [
            'team_id' => $this->faker->numberBetween(1, $maxTeamId),
            'user_id' => $this->faker->numberBetween(1, $maxUserId),
        ];
    }
}
