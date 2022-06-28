<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{

    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $clients = collect(Client::all()->modelKeys());
        $users = collect(User::all()->modelKeys());

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 month'),
            'user_id' => $users->random(),
            'client_id' => $clients->random(),
            'status' => Arr::random(Project::STATUS),   
        ];
    }
}
