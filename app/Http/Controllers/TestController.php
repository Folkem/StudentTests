<?php

namespace App\Http\Controllers;

use App\Models\ControlType;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function store(Request $request)
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
        ]);

        Test::query()->create([
            'title' => $request->input('title'),
            'group_id' => $request->input('group'),
            'discipline_id' => $request->input('discipline'),
            'control_type_id' => $request->input('control_type'),
            'time_in_minutes' => $request->input('time_in_minutes'),
            'grade' => $request->input('grade'),
        ]);

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
