<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DisciplineController extends Controller
{
    public function index()
    {
        $disciplines = Discipline::all();

        return view('disciplines.index', compact('disciplines'));
    }

    public function create()
    {
        return view('disciplines.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|between:3,255',
        ]);

        Discipline::query()->create($validated);

        return back()->with('message', 'Дисципліна успішно додана.');
    }

    public function edit(Discipline $discipline)
    {
        return view('disciplines.edit', compact('discipline'));
    }

    public function update(Request $request, Discipline $discipline): RedirectResponse
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'between:3,255',
                Rule::unique('disciplines', 'title')->ignore($discipline->title, 'title'),
            ],
        ]);

        $discipline->update($validated);

        return back()->with('message', 'Дисципліна успішно оновлена.');
    }

    public function destroy(Discipline $discipline): RedirectResponse
    {
        $discipline->delete();

        return back();
    }
}
