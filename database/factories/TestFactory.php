<?php

namespace Database\Factories;

use App\Models\ControlType;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Test;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    protected $model = Test::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->realText(),
            'group_id' => function () {
                return Group::query()->inRandomOrder()->first()->id;
            },
            'discipline_id' => function () {
                return Discipline::query()->inRandomOrder()->first()->id;
            },
            'control_type_id' => function () {
                return ControlType::query()->inRandomOrder()->first()->id;
            },
            'time_in_minutes' => $this->faker->numberBetween(5, 120),
            'grade' => $this->faker->numberBetween(10, 100),
        ];
    }
}
