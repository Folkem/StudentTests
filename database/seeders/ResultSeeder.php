<?php

namespace Database\Seeders;

use App\Models\Result;
use App\Models\Test;
use App\Models\Testing;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testings = Testing::query()->inRandomOrder()->get();
        $count = mt_rand(1, Testing::query()->count());
        for ($i = 0; $i < $count; $i++) {
            $testing = $testings->get($i);
            $users = User::query()
                ->where('role_id', 3)
                ->with('results')
                ->whereDoesntHave('results', function ($result) use ($testing) {
                    $result->where('testing_id', $testing->id);
                })
                ->get();
            if ($users->isNotEmpty()) {
                $resultCount = mt_rand(1, 5);
                for ($i = 0; $i < $resultCount; $i++) {
                    Result::query()
                        ->create([
                            'testing_id' => $testing->id,
                            'user_id' => $users->random()->id,
                        ]);
                }
            }
        }
    }
}
