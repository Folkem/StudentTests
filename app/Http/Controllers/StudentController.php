<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::query()->where('role_id', 3)->get();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $groups = Group::all();

        return view('students.create', compact('groups'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'between:3,255',
                'unique:users,name'
            ],
            'password' => 'required|string|between:3,255|confirmed',
            'group_id' => [
                'required', 'numeric',
                Rule::in(Group::all()->map(fn($g) => $g->id)->all()),
            ],
        ]);

        User::query()->create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 3,
            'group_id' => $request->input('group_id'),
        ]);

        return back()->with('message', 'Студент успішно додан.');
    }

    public function edit(User $student)
    {
        $groups = Group::all();

        return view('students.edit', compact('student', 'groups'));
    }

    public function update(Request $request, User $student): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'between:3,255',
                Rule::unique('users', 'name')->ignore($student->name, 'name'),
            ],
            'old_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($student) {
                    if (!Hash::check($value, $student->password)) {
                        $fail(__('validation.password'));
                    }
                }
            ],
            'password' => 'required|string|between:3,255|confirmed|different:old_password',
            'group_id' => [
                'required', 'numeric',
                Rule::in(Group::all()->map(fn($g) => $g->id)->all()),
            ],
        ]);

        $student->update([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'group_id' => $request->input('group_id'),
        ]);

        return back()->with('message', 'Студент успішно оновлений.');
    }

    public function destroy(User $student): RedirectResponse
    {
        $student->delete();

        return back();
    }
}
