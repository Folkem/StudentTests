<?php

namespace Database\Seeders;

use App\Models\ControlType;
use Illuminate\Database\Seeder;

class ControlTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ControlType::query()->create(['name' => 'Самостійна робота']);
        ControlType::query()->create(['name' => 'Контрольна робота']);
        ControlType::query()->create(['name' => 'Залік']);
        ControlType::query()->create(['name' => 'Екзамен']);
    }
}
