<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramEvent;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;

class ProgramEventController extends Controller
{
    public function index()
    {
        $selectedUnitId = request()->integer('scout_unit_id') ?: null;
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        $programEvents = ProgramEvent::query()
            ->with('scoutUnit')
            ->when($selectedUnitId, fn ($query) => $query->where('scout_unit_id', $selectedUnitId))
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->paginate(18)
            ->withQueryString();

        return view('admin.program-events.index', compact('programEvents', 'units', 'selectedUnitId'));
    }

    public function create()
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();
        $selectedUnitId = request()->integer('scout_unit_id') ?: null;

        return view('admin.program-events.create', compact('units', 'selectedUnitId'));
    }

    public function store(Request $request)
    {
        $programEvent = ProgramEvent::create($this->validatedData($request));

        return redirect()->route('admin.program-events.index', array_filter([
            'scout_unit_id' => $programEvent->scout_unit_id,
        ]))
            ->with('success', 'Evenement cree avec succes.');
    }

    public function edit(ProgramEvent $programEvent)
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();
        $selectedUnitId = $programEvent->scout_unit_id;

        return view('admin.program-events.edit', compact('programEvent', 'units', 'selectedUnitId'));
    }

    public function update(Request $request, ProgramEvent $programEvent)
    {
        $programEvent->update($this->validatedData($request));

        return redirect()->route('admin.program-events.index', array_filter([
            'scout_unit_id' => $programEvent->scout_unit_id,
        ]))
            ->with('success', 'Evenement mis a jour avec succes.');
    }

    public function destroy(ProgramEvent $programEvent)
    {
        $programEvent->delete();

        return redirect()->route('admin.program-events.index')
            ->with('success', 'Evenement supprime avec succes.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'scout_unit_id' => ['nullable', 'exists:scout_units,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:4000'],
            'event_date' => ['required', 'date'],
            'time_label' => ['nullable', 'string', 'max:100'],
            'responsible' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        return $validated;
    }
}
