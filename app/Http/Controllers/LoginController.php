<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function attempt(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string',
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
}
