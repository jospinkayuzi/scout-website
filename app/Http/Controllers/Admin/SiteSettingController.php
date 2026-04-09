<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiteSettingController extends Controller
{
    private const HOMEPAGE_SETTING_KEYS = ['hero', 'mission', 'values', 'objectives', 'contact'];

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

    public function editHomepage()
    {
        return view('admin.site-settings.homepage', [
            'content' => $this->homepageContent(),
        ]);
    }

    public function updateHomepage(Request $request)
    {
        $validated = $request->validate([
            'hero.badge' => ['nullable', 'string', 'max:255'],
            'hero.title' => ['nullable', 'string', 'max:255'],
            'hero.highlight' => ['nullable', 'string', 'max:255'],
            'hero.description' => ['nullable', 'string', 'max:2000'],
            'hero.primary_cta' => ['nullable', 'string', 'max:255'],
            'hero.secondary_cta' => ['nullable', 'string', 'max:255'],
            'mission.subtitle' => ['nullable', 'string', 'max:255'],
            'mission.text' => ['nullable', 'string', 'max:4000'],
            'values.subtitle' => ['nullable', 'string', 'max:500'],
            'values.items' => ['required', 'array', 'size:4'],
            'values.items.*.title' => ['required', 'string', 'max:255'],
            'values.items.*.description' => ['required', 'string', 'max:1000'],
            'objectives.subtitle' => ['nullable', 'string', 'max:500'],
            'objectives.items' => ['required', 'array', 'size:6'],
            'objectives.items.*.title' => ['required', 'string', 'max:255'],
            'contact.email' => ['nullable', 'email', 'max:255'],
            'contact.phone' => ['nullable', 'string', 'max:100'],
            'contact.address' => ['nullable', 'string', 'max:255'],
        ]);

        $current = $this->homepageContent();

        $hero = array_merge($current['hero'], $validated['hero'] ?? []);
        $mission = array_merge($current['mission'], $validated['mission'] ?? []);
        $contact = array_merge($current['contact'], $validated['contact'] ?? []);

        $values = $current['values'];
        $values['subtitle'] = $validated['values']['subtitle'] ?? ($values['subtitle'] ?? null);
        $values['items'] = collect($validated['values']['items'] ?? [])
            ->map(function (array $item, int $index) use ($current) {
                $existing = $current['values']['items'][$index] ?? [];

                return array_merge($existing, [
                    'title' => $item['title'],
                    'description' => $item['description'],
                ]);
            })
            ->all();

        $objectives = $current['objectives'];
        $objectives['subtitle'] = $validated['objectives']['subtitle'] ?? ($objectives['subtitle'] ?? null);
        $objectives['items'] = collect($validated['objectives']['items'] ?? [])
            ->map(function (array $item, int $index) use ($current) {
                $existing = $current['objectives']['items'][$index] ?? [];

                if (is_array($existing)) {
                    return array_merge($existing, ['title' => $item['title']]);
                }

                return $item['title'];
            })
            ->all();

        $this->persistSetting('hero', $hero);
        $this->persistSetting('mission', $mission);
        $this->persistSetting('values', $values);
        $this->persistSetting('objectives', $objectives);
        $this->persistSetting('contact', $contact);

        return redirect()->route('admin.site-settings.homepage.edit')
            ->with('success', "Le contenu de l'accueil a ete mis a jour avec succes.");
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

    private function homepageContent(): array
    {
        $defaults = config('site_content.settings', []);
        $settings = SiteSetting::query()
            ->whereIn('key', self::HOMEPAGE_SETTING_KEYS)
            ->pluck('value', 'key')
            ->map(fn ($value) => SiteSetting::decode($value));

        return [
            'hero' => array_replace_recursive($defaults['hero'] ?? [], $this->arrayValue($settings->get('hero'))),
            'mission' => array_replace_recursive($defaults['mission'] ?? [], $this->arrayValue($settings->get('mission'))),
            'values' => array_replace_recursive($defaults['values'] ?? [], $this->arrayValue($settings->get('values'))),
            'objectives' => array_replace_recursive($defaults['objectives'] ?? [], $this->arrayValue($settings->get('objectives'))),
            'contact' => array_replace_recursive($defaults['contact'] ?? [], $this->arrayValue($settings->get('contact'))),
        ];
    }

    private function arrayValue(mixed $value): array
    {
        return is_array($value) ? $value : [];
    }

    private function persistSetting(string $key, array $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value, JSON_UNESCAPED_UNICODE)]
        );
    }
}
