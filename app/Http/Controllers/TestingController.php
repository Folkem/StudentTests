<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ResultAnswer;
use App\Models\Test;
use App\Models\Testing;
use Exception;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function studentIndex()
    {
        $testings = Testing::with('test')->whereHas('test', function ($test) {
            /** @noinspection PhpUndefinedFieldInspection */
            $test->where('group_id', auth()->user()->group_id);
        })->whereDoesntHave('results', function ($result) {
            $result->where('user_id', auth()->id());
        })->get();

        return view('testings.student.index', compact('testings'));
    }

    public function studentPass(Testing $testing)
    {
        $userHasResult = $testing->results()->where('user_id', auth()->id())->exists();
        if ($userHasResult) {
            return back();
        }

        $test = $testing->test;
        $questions = $test->questions;
        return view('testings.student.pass', compact('testing', 'questions'));
    }

    public function studentEnd(Request $request, Testing $testing)
    {
        $userHasResult = $testing->results()->where('user_id', auth()->id())->exists();
        if (!$testing->continues() || $userHasResult) {
            return redirect(route('home'));
        }

        $result = Result::query()->create([
            'testing_id' => $testing->id,
            'user_id' => auth()->id(),
        ]);

        $answers = $request->only($testing->test->questions->map(fn($q) => $q->id)->all());

        foreach ($answers as $answer) {
            try {
                ResultAnswer::query()->create([
                    'result_id' => $result->id,
                    'answer_id' => $answer,
                ]);
            } catch (Exception $e) {
                logger()->warning(sprintf("%s at %s:%s", $e->getMessage(), $e->getFile(), $e->getLine()));
            }
        }

        return redirect(route('home'));
    }

    public function teacherStart(Test $test)
    {
        Testing::query()
            ->create([
                'test_id' => $test->id,
                'started_at' => now(),
            ]);

        return back();
    }
}
