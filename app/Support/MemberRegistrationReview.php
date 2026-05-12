<?php

namespace App\Support;

use App\Models\Member;
use App\Models\ScoutUnit;
use App\Models\User;

class MemberRegistrationReview
{
    private const GROUP_CHIEF_FUNCTIONS = [
        'Cheffe de Groupe',
        'Chef de Groupe',
    ];

    private const UNIT_CHIEF_FUNCTION_MAP = [
        'Akela (Chef d\'unité Meute)' => 'meute',
        'Troupe F' => 'troupe-f',
        'Troupe M' => 'troupe-m',
        'Grappe' => 'grappe',
        'Route' => 'route',
        'Amical' => 'amical',
    ];

    public static function forUser(User $user): array
    {
        if ($user->isSuperAdmin() || $user->hasPermission('gerer_membres')) {
            return [
                'can_review' => true,
                'can_manage_all_units' => true,
                'allowed_unit_ids' => ScoutUnit::query()->where('is_active', true)->pluck('id')->all(),
            ];
        }

        $member = Member::query()
            ->where('status', 'active')
            ->whereNotNull('email')
            ->whereRaw('LOWER(email) = ?', [strtolower((string) $user->email)])
            ->first();

        if (!$member) {
            return [
                'can_review' => false,
                'can_manage_all_units' => false,
                'allowed_unit_ids' => [],
            ];
        }

        if (in_array($member->member_function, self::GROUP_CHIEF_FUNCTIONS, true)) {
            return [
                'can_review' => true,
                'can_manage_all_units' => true,
                'allowed_unit_ids' => ScoutUnit::query()->where('is_active', true)->pluck('id')->all(),
            ];
        }

        $allowedSlug = self::UNIT_CHIEF_FUNCTION_MAP[$member->member_function] ?? null;

        if (!$allowedSlug) {
            return [
                'can_review' => false,
                'can_manage_all_units' => false,
                'allowed_unit_ids' => [],
            ];
        }

        $allowedUnitId = ScoutUnit::query()
            ->where('is_active', true)
            ->where('slug', $allowedSlug)
            ->value('id');

        if (!$allowedUnitId) {
            return [
                'can_review' => false,
                'can_manage_all_units' => false,
                'allowed_unit_ids' => [],
            ];
        }

        return [
            'can_review' => true,
            'can_manage_all_units' => false,
            'allowed_unit_ids' => [$allowedUnitId],
        ];
    }

    public static function canReviewMember(array $access, Member $member): bool
    {
        if (!$access['can_review']) {
            return false;
        }

        if ($access['can_manage_all_units']) {
            return true;
        }

        return $member->scout_unit_id !== null
            && in_array($member->scout_unit_id, $access['allowed_unit_ids'], true);
    }
}
