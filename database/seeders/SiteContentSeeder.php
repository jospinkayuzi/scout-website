<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\ProgramEvent;
use App\Models\Publication;
use App\Models\ScoutUnit;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteContentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (config('site_content.settings', []) as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => json_encode($value, JSON_UNESCAPED_UNICODE)]
            );
        }

        foreach (config('site_content.units', []) as $unit) {
            ScoutUnit::updateOrCreate(
                ['slug' => $unit['slug']],
                $unit
            );
        }

        $units = ScoutUnit::query()->pluck('id', 'slug');

        foreach (config('site_content.publications', []) as $publication) {
            $unitSlug = $publication['unit_slug'];
            unset($publication['unit_slug']);
            $publication['scout_unit_id'] = $unitSlug ? $units[$unitSlug] ?? null : null;

            Publication::updateOrCreate(
                ['title' => $publication['title']],
                $publication
            );
        }

        foreach (config('site_content.gallery', []) as $item) {
            $unitSlug = $item['unit_slug'];
            unset($item['unit_slug']);
            $item['scout_unit_id'] = $unitSlug ? $units[$unitSlug] ?? null : null;

            GalleryItem::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }

        foreach (config('site_content.members', []) as $member) {
            $unitSlug = $member['unit_slug'];
            unset($member['unit_slug']);
            $member['scout_unit_id'] = $unitSlug ? $units[$unitSlug] ?? null : null;

            Member::updateOrCreate(
                [
                    'first_name' => $member['first_name'],
                    'last_name' => $member['last_name'],
                    'birth_date' => $member['birth_date'],
                ],
                $member
            );
        }

        foreach (config('site_content.program_events', []) as $event) {
            $unitSlug = $event['unit_slug'];
            unset($event['unit_slug']);
            $event['scout_unit_id'] = $unitSlug ? ($units[$unitSlug] ?? null) : null;

            ProgramEvent::updateOrCreate(
                [
                    'scout_unit_id' => $event['scout_unit_id'],
                    'title' => $event['title'],
                    'event_date' => $event['event_date'],
                ],
                $event
            );
        }
    }
}
