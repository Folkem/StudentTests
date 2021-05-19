<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ControlType;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Question;
use App\Models\Test;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::all();

        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $disciplines = Discipline::all();
        $groups = Group::all();
        $controlTypes = ControlType::all();

        return view('tests.create', compact('disciplines', 'groups', 'controlTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|between:3,255',
            'group' => [
                'required',
                'numeric',
                Rule::in(Group::all()->map(fn($group) => $group->id)->all())
            ],
            'discipline' => [
                'required',
                'numeric',
                Rule::in(Discipline::all()->map(fn($discipline) => $discipline->id)->all())
            ],
            'control_type' => [
                'required',
                'numeric',
                Rule::in(ControlType::all()->map(fn($controlType) => $controlType->id)->all())
            ],
            'time_in_minutes' => 'required|numeric|min:1',
            'grade' => 'required|numeric|min:1',
            'questions_file' => 'required|file|mimetypes:text/plain',
        ]);

        $fileContents = $request->file('questions_file')->get();

        $test = Test::query()->create([
                'title' => $request->input('title'),
                'group_id' => $request->input('group'),
                'discipline_id' => $request->input('discipline'),
                'control_type_id' => $request->input('control_type'),
                'time_in_minutes' => $request->input('time_in_minutes'),
                'grade' => $request->input('grade'),
            ]);

        try {
            $currentQuestion = null;
            foreach (explode("\n", $fileContents) as $chunk) {
                if (str_starts_with($chunk, 'П: ')) {
                    $currentQuestion = Question::query()->create([
                        'body' => mb_substr($chunk, 3),
                        'test_id' => $test->id,
                    ]);
                } elseif (str_starts_with($chunk, '* ')) {
                    Answer::query()->create([
                        'body' => mb_substr($chunk, 2),
                        'is_correct' => false,
                        'question_id' => $currentQuestion->id,
                    ]);
                } elseif (str_starts_with($chunk, '** ')) {
                    Answer::query()->create([
                        'body' => mb_substr($chunk, 3),
                        'is_correct' => true,
                        'question_id' => $currentQuestion->id,
                    ]);
                }
            }
        } catch (Exception $exception) {
            Log::error("Помилка читання файлу: {$exception->getMessage()}");
            return back()->withErrors('Помилка читання файлу. Перевірте його коректність. Тест був ' .
                'збережений. ');
        }

        return back()->with('message', 'Тест успішно створено.');
    }

    public function show(Test $test)
    {
        return view('tests.show', compact('test'));
    }

    public function destroy(Test $test): RedirectResponse
    {
        $test->delete();

        return back();
    }
}
