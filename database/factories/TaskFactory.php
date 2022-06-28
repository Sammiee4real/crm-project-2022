<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $projects = collect(Project::all()->modelKeys());

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'deadline' => $this->faker->dateTimeBetween('+1 month', '+6 month'),
            'project_id' => $projects->random(),
            'status' => Arr::random(Task::STATUS),       
        ];

    }
}
