<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|between:3,255',
        ]);

        Group::query()->create($validated);

        return back()->with('message', 'Група успішно додана.');
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group): RedirectResponse
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'between:3,255',
                Rule::unique('groups', 'title')->ignore($group->title, 'title'),
            ],
        ]);

        $group->update($validated);

        return back()->with('message', 'Група успішно оновлена.');
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return back();
    }
}
