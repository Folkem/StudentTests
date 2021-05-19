<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $tests = Test::factory()->count(10)->create();
        foreach ($tests as $test) {
            $questions = Question::factory()->count(mt_rand(1, 15))
                ->create(['test_id' => $test->id]);

            foreach ($questions as $question) {
                for ($i = 0; $i < 4; $i++) {
                    Answer::query()->create([
                        'body' => $faker->realTextBetween(10, 100),
                        'is_correct' => $i === 0,
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }
}
