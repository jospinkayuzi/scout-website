<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScoutUnitController extends Controller
{
    public function index()
    {
        $units = ScoutUnit::query()
            ->withCount(['members', 'publications', 'programEvents', 'galleryItems'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12);

        return view('admin.scout-units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.scout-units.create');
    }

    public function store(Request $request)
    {
        ScoutUnit::create($this->validatedData($request));

        return redirect()->route('admin.scout-units.index')
            ->with('success', 'Unite creee avec succes.');
    }

    public function edit(ScoutUnit $scoutUnit)
    {
        $scoutUnit->loadCount(['galleryItems', 'publications', 'programEvents', 'members']);

        return view('admin.scout-units.edit', compact('scoutUnit'));
    }

    public function update(Request $request, ScoutUnit $scoutUnit)
    {
        $scoutUnit->update($this->validatedData($request, $scoutUnit));

        return redirect()->route('admin.scout-units.index')
            ->with('success', 'Unite mise a jour avec succes.');
    }

    public function destroy(ScoutUnit $scoutUnit)
    {
        $scoutUnit->delete();

        return redirect()->route('admin.scout-units.index')
            ->with('success', 'Unite supprimee avec succes.');
    }

    private function validatedData(Request $request, ?ScoutUnit $scoutUnit = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('scout_units', 'slug')->ignore($scoutUnit?->id)],
            'age_range' => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:1000'],
            'long_description' => ['nullable', 'string', 'max:4000'],
            'icon' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:50'],
            'accent_color' => ['nullable', 'string', 'max:120'],
            'leader_name' => ['nullable', 'string', 'max:255'],
            'schedule' => ['nullable', 'string', 'max:255'],
            'gender_scope' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
