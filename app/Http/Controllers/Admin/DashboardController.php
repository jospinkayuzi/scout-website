<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\Permission;
use App\Models\ProgramEvent;
use App\Models\Publication;
use App\Models\Role;
use App\Models\ScoutUnit;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $overviewCards = [
            [
                'value' => User::count(),
                'label' => 'Utilisateurs',
                'icon' => 'fa-solid fa-users',
                'theme' => 'green',
            ],
            [
                'value' => Role::count(),
                'label' => 'Roles',
                'icon' => 'fa-solid fa-shield-halved',
                'theme' => 'amber',
            ],
            [
                'value' => Permission::count(),
                'label' => 'Permissions',
                'icon' => 'fa-solid fa-key',
                'theme' => 'blue',
            ],
        ];

        if (Schema::hasTable('members')) {
            $overviewCards[] = [
                'value' => Member::where('status', 'active')->count(),
                'label' => 'Membres actifs',
                'icon' => 'fa-solid fa-user-check',
                'theme' => 'purple',
            ];
            $overviewCards[] = [
                'value' => Member::where('status', 'pending')->count(),
                'label' => 'Demandes en attente',
                'icon' => 'fa-solid fa-hourglass-half',
                'theme' => 'amber',
            ];
        }

        if (Schema::hasTable('scout_units')) {
            $overviewCards[] = [
                'value' => ScoutUnit::where('is_active', true)->count(),
                'label' => 'Unites actives',
                'icon' => 'fa-solid fa-tents',
                'theme' => 'green',
            ];
        }

        if (Schema::hasTable('publications')) {
            $overviewCards[] = [
                'value' => Publication::where('is_published', true)->count(),
                'label' => 'Publications',
                'icon' => 'fa-solid fa-newspaper',
                'theme' => 'blue',
            ];
        }

        if (Schema::hasTable('gallery_items')) {
            $overviewCards[] = [
                'value' => GalleryItem::count(),
                'label' => 'Medias',
                'icon' => 'fa-solid fa-images',
                'theme' => 'purple',
            ];
        }

        if (Schema::hasTable('program_events')) {
            $overviewCards[] = [
                'value' => ProgramEvent::whereDate('event_date', '>=', now()->toDateString())->count(),
                'label' => 'Evenements a venir',
                'icon' => 'fa-solid fa-calendar-week',
                'theme' => 'amber',
            ];
        }

        $recentUsers = User::with('role')
            ->latest()
            ->take(5)
            ->get();

        $recentMembers = Schema::hasTable('members')
            ? Member::with('scoutUnit')->orderByDesc('registered_at')->latest()->take(5)->get()
            : collect();

        $recentPublications = Schema::hasTable('publications')
            ? Publication::with('scoutUnit')->orderByDesc('publication_date')->take(5)->get()
            : collect();

        $upcomingEvents = Schema::hasTable('program_events')
            ? ProgramEvent::with('scoutUnit')
                ->whereDate('event_date', '>=', now()->toDateString())
                ->orderBy('event_date')
                ->orderBy('sort_order')
                ->take(5)
                ->get()
            : collect();

        $contentModules = collect([
            [
                'label' => 'Unites',
                'description' => 'Gerer les branches, leaders, couleurs et ordre d affichage du site.',
                'icon' => 'fa-solid fa-tents',
                'count' => Schema::hasTable('scout_units') ? ScoutUnit::count() : 0,
                'theme' => 'green',
                'route' => route('admin.scout-units.index'),
                'permission' => 'gerer_parametres',
            ],
            [
                'label' => 'Programme',
                'description' => 'Planifier les evenements publics et l agenda des unites.',
                'icon' => 'fa-solid fa-calendar-days',
                'count' => Schema::hasTable('program_events') ? ProgramEvent::count() : 0,
                'theme' => 'amber',
                'route' => route('admin.program-events.index'),
                'permission' => 'gerer_parametres',
            ],
            [
                'label' => 'Publications',
                'description' => 'Publier reglements, annonces, articles et documents officiels.',
                'icon' => 'fa-solid fa-newspaper',
                'count' => Schema::hasTable('publications') ? Publication::count() : 0,
                'theme' => 'blue',
                'route' => route('admin.publications.index'),
                'permission' => 'gerer_publications',
            ],
            [
                'label' => 'Galerie',
                'description' => 'Mettre a jour les medias, captions et mises en avant.',
                'icon' => 'fa-solid fa-images',
                'count' => Schema::hasTable('gallery_items') ? GalleryItem::count() : 0,
                'theme' => 'purple',
                'route' => route('admin.gallery-items.index'),
                'permission' => 'gerer_galerie',
            ],
            [
                'label' => 'Membres',
                'description' => 'Suivre les inscriptions, statuts et informations des membres.',
                'icon' => 'fa-solid fa-id-card',
                'count' => Schema::hasTable('members') ? Member::count() : 0,
                'theme' => 'green',
                'route' => route('admin.members.index'),
                'permission' => 'gerer_membres',
            ],
            [
                'label' => 'Parametres',
                'description' => 'Ajuster le contenu du hero, mission, valeurs, objectifs et contact.',
                'icon' => 'fa-solid fa-sliders',
                'count' => Schema::hasTable('site_settings') ? SiteSetting::count() : 0,
                'theme' => 'blue',
                'route' => route('admin.site-settings.index'),
                'permission' => 'gerer_parametres',
            ],
        ])->filter(function (array $module) {
            return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission($module['permission']);
        })->values();

        return view('admin.dashboard', compact(
            'overviewCards',
            'recentUsers',
            'recentMembers',
            'recentPublications',
            'upcomingEvents',
            'contentModules',
        ));
    }
}
