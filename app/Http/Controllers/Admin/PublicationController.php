<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::query()
            ->with('scoutUnit')
            ->orderByDesc('publication_date')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.publications.index', compact('publications'));
    }

    public function create()
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.publications.create', compact('units'));
    }

    public function store(Request $request)
    {
        Publication::create($this->validatedData($request));

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication creee avec succes.');
    }

    public function edit(Publication $publication)
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.publications.edit', compact('publication', 'units'));
    }

    public function update(Request $request, Publication $publication)
    {
        $publication->update($this->validatedData($request));

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication mise a jour avec succes.');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication supprimee avec succes.');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'scout_unit_id' => ['nullable', 'exists:scout_units,id'],
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:statut,reglement,article,annonce'],
            'author' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1200'],
            'body' => ['nullable', 'string', 'max:20000'],
            'publication_date' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        return $validated;
    }
}
