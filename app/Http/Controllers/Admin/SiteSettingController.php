<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::query()
            ->orderBy('key')
            ->paginate(20);

        return view('admin.site-settings.index', compact('siteSettings'));
    }

    public function create()
    {
        return view('admin.site-settings.create');
    }

    public function store(Request $request)
    {
        SiteSetting::create($this->validatedData($request));

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Parametre cree avec succes.');
    }

    public function edit(SiteSetting $siteSetting)
    {
        $formattedValue = $this->formatValue($siteSetting);

        return view('admin.site-settings.edit', compact('siteSetting', 'formattedValue'));
    }

    public function update(Request $request, SiteSetting $siteSetting)
    {
        $siteSetting->update($this->validatedData($request, $siteSetting));

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Parametre mis a jour avec succes.');
    }

    public function destroy(SiteSetting $siteSetting)
    {
        $siteSetting->delete();

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Parametre supprime avec succes.');
    }

    private function validatedData(Request $request, ?SiteSetting $siteSetting = null): array
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9._-]+$/', Rule::unique('site_settings', 'key')->ignore($siteSetting?->id)],
            'value' => ['nullable', 'string'],
        ]);

        $decoded = json_decode($validated['value'] ?? '', true);
        $validated['value'] = json_last_error() === JSON_ERROR_NONE
            ? json_encode($decoded, JSON_UNESCAPED_UNICODE)
            : ($validated['value'] ?: null);

        return $validated;
    }

    private function formatValue(SiteSetting $siteSetting): string
    {
        $decoded = SiteSetting::decode($siteSetting->value);

        if (is_array($decoded)) {
            return json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        }

        return (string) $siteSetting->value;
    }
}
