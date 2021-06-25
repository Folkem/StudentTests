<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\Testing;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::all()
            ->random(mt_rand(1, Test::query()->count()))
            ->each(function ($test) {
                Testing::query()
                    ->create([
                        'test_id' => $test->id,
                        'started_at' => now()->subMinutes(mt_rand(0, $test->time_in_minutes)),
                    ]);
            });
    }
}
