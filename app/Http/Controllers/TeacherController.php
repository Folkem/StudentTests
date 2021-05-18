<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index()
    {
        $teacherRoleId = Role::query()->where('name', 'teacher')->first('id')->id;
        $teachers = User::query()->where('role_id', $teacherRoleId)->get();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|between:3,255',
            'email' => [
                'required',
                'email',
                'between:3,255',
                'unique:users,email'
            ],
            'password' => 'required|string|between:3,255|confirmed'
        ]);

        User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role_id' => Role::query()->where('name', 'teacher')->first()->id
        ]);

        return back()->with('message', 'Вчитель успішно додан.');
    }

    public function edit(User $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|between:3,255',
            'email' => [
                'required',
                'email',
                'between:3,255',
                Rule::unique('users', 'email')->ignore($teacher->email, 'email'),
            ],
            'old_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($teacher) {
                    if (!Hash::check($value, $teacher->password)) {
                        $fail(__('validation.password'));
                    }
                }
            ],
            'password' => 'required|string|between:3,255|confirmed|different:old_password'
        ]);

        $teacher->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return back()->with('message', 'Вчитель успішно оновлений.');
    }

    public function destroy(User $teacher): RedirectResponse
    {
        $teacher->delete();

        return back();
    }
}