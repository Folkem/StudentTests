<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function registerShow()
    {
        $groups = Group::all();

        return view('register', compact('groups'));
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => [
                'required', 'string', 'between:5,255',
                Rule::unique('users', 'name'),
            ],
            'group_id' => [
                'required', 'numeric',
                Rule::in(Group::all()->map(fn($g) => $g->id)->all()),
            ],
            'password' => [
                'required', 'string',
            ],
        ]);

        $user = User::query()->create([
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role_id' => 3,
        ]);

        /** @noinspection PhpParamsInspection */
        auth()->login($user);

        return redirect(route('home'));
    }

    public function attempt(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $passed = auth()->attempt($validated);

        if (!$passed) {
            return back()->withErrors([
                __('auth.failed')
            ]);
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
