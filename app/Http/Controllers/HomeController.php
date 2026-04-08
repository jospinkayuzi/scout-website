<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\ProgramEvent;
use App\Models\Publication;
use App\Models\ScoutUnit;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.home', [
            ...$this->sharedPageData(),
            'featuredUnits' => $this->loadUnits(),
            'latestPublications' => $this->loadPublications(3),
            'featuredGalleryItems' => $this->loadGalleryItems(4, true),
            'upcomingEvents' => $this->loadUpcomingEvents(4),
        ]);
    }

    public function units()
    {
        return view('site.units', [
            ...$this->sharedPageData(),
            'units' => $this->loadUnits(),
        ]);
    }

    public function program()
    {
        return view('site.program', [
            ...$this->sharedPageData(),
            'units' => $this->loadUnits(),
            'groupUpcomingEvents' => $this->loadUpcomingEvents(groupOnly: true),
        ]);
    }

    public function publications()
    {
        $publications = $this->loadPublications();

        return view('site.publications', [
            ...$this->sharedPageData(),
            'publications' => $publications,
            'publicationSummary' => [
                'total' => $publications->count(),
                'statuts' => $publications->where('type', 'statut')->count(),
                'reglements' => $publications->where('type', 'reglement')->count(),
                'articles' => $publications->where('type', 'article')->count(),
                'annonces' => $publications->where('type', 'annonce')->count(),
            ],
        ]);
    }

    public function gallery()
    {
        $galleryItems = $this->loadGalleryItems();

        return view('site.gallery', [
            ...$this->sharedPageData(),
            'galleryItems' => $galleryItems,
            'featuredGalleryItems' => $galleryItems->where('is_featured', true)->take(3)->values(),
        ]);
    }

    public function members()
    {
        return view('site.members', [
            ...$this->sharedPageData(),
            'recentMembers' => $this->loadRecentMembers(8),
            'membersByUnit' => $this->loadMembersByUnit(),
            'maitriseMembers' => $this->loadMaitriseMembers(),
        ]);
    }

    public function join()
    {
        return view('site.join', [
            ...$this->sharedPageData(),
            'units' => $this->loadUnits(),
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'scout_unit_id' => ['required', 'exists:scout_units,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:1000'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'medical_notes' => ['nullable', 'string', 'max:2000'],
            'motivation' => ['nullable', 'string', 'max:2000'],
        ]);

        $unit = ScoutUnit::findOrFail($validated['scout_unit_id']);

        $this->enforceUnitRules($unit, $validated);

        Member::create([
            ...$validated,
            'status' => 'pending',
            'member_function' => 'Membre',
            'medical_notes' => $validated['medical_notes'] ?? 'Aucune',
            'registered_at' => now()->toDateString(),
        ]);

        return redirect()->route('site.join')
            ->with('success', "L'inscription a ete enregistree avec succes.");
    }

    private function sharedPageData(): array
    {
        $settings = $this->settings();
        $memberStats = $this->memberStats();

        return [
            'hero' => $settings->get('hero', config('site_content.settings.hero', [])),
            'mission' => $settings->get('mission', config('site_content.settings.mission', [])),
            'values' => $settings->get('values', config('site_content.settings.values', [])),
            'objectives' => $settings->get('objectives', config('site_content.settings.objectives', [])),
            'contact' => $settings->get('contact', config('site_content.settings.contact', [])),
            'memberStats' => $memberStats,
            'siteStats' => [
                'members_active' => $memberStats['active'],
                'units' => Schema::hasTable('scout_units') ? ScoutUnit::where('is_active', true)->count() : 0,
                'publications' => Schema::hasTable('publications') ? Publication::where('is_published', true)->count() : 0,
                'media' => Schema::hasTable('gallery_items') ? GalleryItem::count() : 0,
                'events' => Schema::hasTable('program_events')
                    ? ProgramEvent::where('is_public', true)->whereDate('event_date', '>=', now()->toDateString())->count()
                    : 0,
            ],
        ];
    }

    private function settings(): Collection
    {
        $defaults = collect(config('site_content.settings', []));

        if (!Schema::hasTable('site_settings')) {
            return $defaults;
        }

        $databaseSettings = SiteSetting::query()
            ->pluck('value', 'key')
            ->map(fn ($value) => SiteSetting::decode($value));

        return $defaults->merge($databaseSettings);
    }

    private function loadUnits(?int $limit = null): Collection
    {
        if (!Schema::hasTable('scout_units')) {
            return collect();
        }

        $query = ScoutUnit::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name');

        if (Schema::hasTable('members')) {
            $query->withCount([
                'members',
                'members as active_members_count' => fn ($memberQuery) => $memberQuery->where('status', 'active'),
            ]);
        }

        if (Schema::hasTable('program_events')) {
            $query->with([
                'programEvents' => fn ($eventQuery) => $eventQuery
                    ->where('is_public', true)
                    ->whereRaw('DAYOFWEEK(event_date) = 7') // Saturday
                    ->orderBy('event_date')
                    ->orderBy('sort_order'),
            ]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function loadPublications(?int $limit = null): Collection
    {
        if (!Schema::hasTable('publications')) {
            return collect();
        }

        $query = Publication::query()
            ->with('scoutUnit')
            ->where('is_published', true)
            ->orderByDesc('publication_date')
            ->orderBy('sort_order');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function loadGalleryItems(?int $limit = null, bool $featuredOnly = false): Collection
    {
        if (!Schema::hasTable('gallery_items')) {
            return collect();
        }

        $query = GalleryItem::query()
            ->with('scoutUnit')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('taken_at');

        if ($featuredOnly) {
            $query->where('is_featured', true);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function loadRecentMembers(?int $limit = null): Collection
    {
        if (!Schema::hasTable('members')) {
            return collect();
        }

        $query = Member::query()
            ->with('scoutUnit')
            ->orderByDesc('registered_at')
            ->orderByDesc('created_at');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function loadUpcomingEvents(?int $limit = null, bool $groupOnly = false): Collection
    {
        if (!Schema::hasTable('program_events')) {
            return collect();
        }

        $query = ProgramEvent::query()
            ->with('scoutUnit')
            ->where('is_public', true)
            ->whereDate('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->orderBy('sort_order');

        if ($groupOnly) {
            $query->whereNull('scout_unit_id');
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    private function loadMembersByUnit(): Collection
    {
        if (!Schema::hasTable('scout_units') || !Schema::hasTable('members')) {
            return collect();
        }

        return ScoutUnit::query()
            ->withCount([
                'members',
                'members as active_members_count' => fn ($memberQuery) => $memberQuery->where('status', 'active'),
                'members as pending_members_count' => fn ($memberQuery) => $memberQuery->where('status', 'pending'),
            ])
            ->orderBy('sort_order')
            ->get();
    }

    private function loadMaitriseMembers(): Collection
    {
        if (!Schema::hasTable('members')) {
            return collect();
        }

        $maitriseFunctions = [
            'Cheffe de Groupe',
            'Assistant chef de groupe',
            'Secrétaire',
            'Trésorier(e)',
            'Akela (Chef d\'unité Meute)',
            'Baghera (Assistants)',
            'Baloo',
            'Troupe F',
            'Troupe M',
            'Grappe',
            'Amical',
            'Disciplinaire',
            'Chargé du matériel',
            'Chargée du social',
            'Chargé de la communication',
            'Animation du groupe',
            'Chargé de la spiritualité',
            'Chargé des projets, partenariats et développement du groupe',
            'Chargé des événements et de l\'expression des talents',
        ];

        return Member::query()
            ->whereIn('member_function', $maitriseFunctions)
            ->where('status', 'active')
            ->orderBy('member_function')
            ->get();
    }

    private function memberStats(): array
    {
        if (!Schema::hasTable('members')) {
            return [
                'active' => 0,
                'pending' => 0,
                'inactive' => 0,
                'total' => 0,
            ];
        }

        return [
            'active' => Member::where('status', 'active')->count(),
            'pending' => Member::where('status', 'pending')->count(),
            'inactive' => Member::where('status', 'inactive')->count(),
            'total' => Member::count(),
        ];
    }

    private function enforceUnitRules(ScoutUnit $unit, array $validated): void
    {
        if (in_array($unit->slug, ['meute', 'troupe-f', 'troupe-m', 'grappe'], true) && blank($validated['parent_name'] ?? null)) {
            throw ValidationException::withMessages([
                'parent_name' => 'Le parent ou tuteur est obligatoire pour cette unite.',
            ]);
        }

        if (in_array($unit->slug, ['route', 'amical'], true) && blank($validated['phone'] ?? null)) {
            throw ValidationException::withMessages([
                'phone' => 'Le telephone est obligatoire pour cette unite.',
            ]);
        }
    }
}
