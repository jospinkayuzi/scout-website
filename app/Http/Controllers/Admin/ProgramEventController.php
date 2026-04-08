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
        $programEvents = ProgramEvent::query()
            ->with('scoutUnit')
            ->orderBy('event_date')
            ->orderBy('sort_order')
            ->paginate(18);

        return view('admin.program-events.index', compact('programEvents'));
    }

    public function create()
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.program-events.create', compact('units'));
    }

    public function store(Request $request)
    {
        ProgramEvent::create($this->validatedData($request));

        return redirect()->route('admin.program-events.index')
            ->with('success', 'Evenement cree avec succes.');
    }

    public function edit(ProgramEvent $programEvent)
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.program-events.edit', compact('programEvent', 'units'));
    }

    public function update(Request $request, ProgramEvent $programEvent)
    {
        $programEvent->update($this->validatedData($request));

        return redirect()->route('admin.program-events.index')
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
