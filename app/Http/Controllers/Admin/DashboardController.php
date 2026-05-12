<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\ProgramEvent;
use App\Models\Publication;
use App\Models\ScoutUnit;
use App\Support\MemberRegistrationReview;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $canAccess = fn (string $permission): bool => $user->isSuperAdmin() || $user->hasPermission($permission);

        $reviewAccess = Schema::hasTable('members') && Schema::hasTable('scout_units')
            ? MemberRegistrationReview::forUser($user)
            : [
                'can_review' => false,
                'can_manage_all_units' => false,
                'allowed_unit_ids' => [],
            ];

        $activeMembersCount = 0;
        $pendingMembersCount = 0;

        if (Schema::hasTable('members')) {
            $activeMembersQuery = Member::query()->where('status', 'active');
            $pendingMembersQuery = Member::query()->where('status', 'pending');

            if ($reviewAccess['can_review'] && !$reviewAccess['can_manage_all_units']) {
                $activeMembersQuery->whereIn('scout_unit_id', $reviewAccess['allowed_unit_ids']);
                $pendingMembersQuery->whereIn('scout_unit_id', $reviewAccess['allowed_unit_ids']);
            }

            $activeMembersCount = $activeMembersQuery->count();
            $pendingMembersCount = $pendingMembersQuery->count();
        }

        $overviewCards = [];

        if (Schema::hasTable('members') && ($reviewAccess['can_review'] || $canAccess('gerer_membres'))) {
            $overviewCards[] = [
                'value' => $activeMembersCount,
                'label' => $reviewAccess['can_review'] && !$reviewAccess['can_manage_all_units'] ? 'Membres actifs de mon unite' : 'Membres actifs',
                'icon' => 'fa-solid fa-user-check',
                'theme' => 'purple',
            ];
            $overviewCards[] = [
                'value' => $pendingMembersCount,
                'label' => $reviewAccess['can_review'] && !$reviewAccess['can_manage_all_units'] ? 'Demandes de mon unite' : 'Demandes en attente',
                'icon' => 'fa-solid fa-hourglass-half',
                'theme' => 'amber',
            ];
        }

        if (Schema::hasTable('scout_units') && $canAccess('gerer_parametres')) {
            $overviewCards[] = [
                'value' => ScoutUnit::where('is_active', true)->count(),
                'label' => 'Unites actives',
                'icon' => 'fa-solid fa-tents',
                'theme' => 'green',
            ];
        }

        if (Schema::hasTable('publications') && $canAccess('gerer_publications')) {
            $overviewCards[] = [
                'value' => Publication::where('is_published', true)->count(),
                'label' => 'Publications',
                'icon' => 'fa-solid fa-newspaper',
                'theme' => 'blue',
            ];
        }

        if (Schema::hasTable('gallery_items') && $canAccess('gerer_galerie')) {
            $overviewCards[] = [
                'value' => GalleryItem::count(),
                'label' => 'Medias',
                'icon' => 'fa-solid fa-images',
                'theme' => 'purple',
            ];
        }

        if (Schema::hasTable('program_events') && $canAccess('gerer_parametres')) {
            $overviewCards[] = [
                'value' => ProgramEvent::whereDate('event_date', '>=', now()->toDateString())->count(),
                'label' => 'Evenements a venir',
                'icon' => 'fa-solid fa-calendar-week',
                'theme' => 'amber',
            ];
        }

        $pendingRegistrations = Schema::hasTable('members')
            ? Member::with('scoutUnit')
                ->where('status', 'pending')
                ->when($reviewAccess['can_review'] && !$reviewAccess['can_manage_all_units'], fn ($query) => $query->whereIn('scout_unit_id', $reviewAccess['allowed_unit_ids']))
                ->orderByDesc('registered_at')
                ->latest()
                ->take(6)
                ->get()
            : collect();

        return view('admin.dashboard', compact(
            'overviewCards',
            'pendingRegistrations',
            'reviewAccess',
        ));
    }
}
