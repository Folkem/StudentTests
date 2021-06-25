<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Testing;
use Illuminate\Http\Request;
use SimpleXLSXGen;

class ResultController extends Controller
{
    public function studentIndex()
    {
        $results = auth()->user()->results()->with('testing')->get();

        return view('results.student.index', compact('results'));
    }

    public function teacherIndex()
    {
        $testings = Testing::with('results')->get();

        return view('results.teacher.index', compact('testings'));
    }

    public function teacherShow(Testing $testing)
    {
        $results = $testing->results;

        return view('results.teacher.show', compact('testing', 'results'));
    }

    // todo
    public function teacherExport(Request $request, Testing $testing)
    {
        $results = $testing->results();

        $resultsJsonArray = $results
            ->with('user')
            ->get()
            ->map(function (Result $result) use ($testing) {
                return [
                    'student' => $result->user->name,
                    'group' => $testing->test->group->title,
                    'theme' => $testing->test->title,
                    'discipline' => $testing->test->discipline->title,
                    'control_type' => $testing->test->controlType->name,
                    'started_at' => $testing->started_at,
                    'time_in_minutes' => $testing->test->time_in_minutes,
                    'grade' => $result->grade,
                ];
            })
            ->all();

        $xlsx = SimpleXLSXGen::fromArray(array_merge([[
            'Студент', 'Група', 'Тема', 'Дисципліна', 'Тип контролю', 'Дата початку', 'Час (в хвилинах)', 'Кількість балів',
        ]], $resultsJsonArray), 'Головний лист');
        $xlsx->downloadAs('Результати тестування.xlsx');
    }
}
