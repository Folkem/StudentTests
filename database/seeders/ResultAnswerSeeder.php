<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Result;
use App\Models\ResultAnswer;
use Illuminate\Database\Seeder;

class ResultAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Result::all()
            ->each(function (Result $result) {
                $questions = $result->testing->test->questions;
                foreach ($questions as $question) {
                    ResultAnswer::query()
                        ->create([
                            'result_id' => $result->id,
                            'answer_id' => $question->answers->random()->id,
                    ]);
                }
            });
    }
}
