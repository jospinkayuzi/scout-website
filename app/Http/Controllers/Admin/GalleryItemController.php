<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\Member;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class GalleryItemController extends Controller
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

    public function index(Request $request)
    {
        $access = $this->galleryAccess($request);
        $units = $this->availableUnits($access);

        $selectedUnitId = request()->integer('scout_unit_id') ?: null;
        $this->ensureSelectedUnitIsAllowed($selectedUnitId, $access);

        $galleryItems = GalleryItem::query()
            ->with('scoutUnit')
            ->when(!$access['can_manage_all_units'], fn ($query) => $query->whereIn('scout_unit_id', $access['allowed_unit_ids']))
            ->when($selectedUnitId, fn ($query) => $query->where('scout_unit_id', $selectedUnitId))
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('taken_at')
            ->paginate(18);

        $galleryItems->appends(request()->query());

        $canManageGlobalGallery = $access['can_manage_global_gallery'];

        return view('admin.gallery-items.index', compact('galleryItems', 'units', 'selectedUnitId', 'canManageGlobalGallery'));
    }

    public function create(Request $request)
    {
        $access = $this->galleryAccess($request);
        $units = $this->availableUnits($access);
        $selectedUnitId = request()->integer('scout_unit_id') ?: ($access['allowed_unit_ids'][0] ?? null);
        $this->ensureSelectedUnitIsAllowed($selectedUnitId, $access);
        $canManageGlobalGallery = $access['can_manage_global_gallery'];

        return view('admin.gallery-items.create', compact('units', 'selectedUnitId', 'canManageGlobalGallery'));
    }

    public function store(Request $request)
    {
        $access = $this->galleryAccess($request);
        $galleryItem = GalleryItem::create($this->validatedData($request, null, $access));

        return redirect()->route('admin.gallery-items.index', array_filter([
            'scout_unit_id' => $galleryItem->scout_unit_id,
        ]))
            ->with('success', 'Media cree avec succes.');
    }

    public function edit(Request $request, GalleryItem $galleryItem)
    {
        $access = $this->galleryAccess($request);
        $this->authorizeGalleryItem($galleryItem, $access);
        $units = $this->availableUnits($access);
        $canManageGlobalGallery = $access['can_manage_global_gallery'];
        $selectedUnitId = $galleryItem->scout_unit_id;

        return view('admin.gallery-items.edit', compact('galleryItem', 'units', 'canManageGlobalGallery', 'selectedUnitId'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $access = $this->galleryAccess($request);
        $this->authorizeGalleryItem($galleryItem, $access);
        $galleryItem->update($this->validatedData($request, $galleryItem, $access));

        return redirect()->route('admin.gallery-items.index', array_filter([
            'scout_unit_id' => $galleryItem->scout_unit_id,
        ]))
            ->with('success', 'Media mis a jour avec succes.');
    }

    public function destroy(Request $request, GalleryItem $galleryItem)
    {
        $access = $this->galleryAccess($request);
        $this->authorizeGalleryItem($galleryItem, $access);
        $this->deleteManagedFile($galleryItem->media_path);
        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')
            ->with('success', 'Media supprime avec succes.');
    }

    private function validatedData(Request $request, ?GalleryItem $galleryItem = null, array $access = []): array
    {
        $unitRules = ['nullable', 'exists:scout_units,id'];

        if (!$access['can_manage_global_gallery']) {
            array_unshift($unitRules, 'required');
            $unitRules[] = Rule::in($access['allowed_unit_ids']);
        } elseif (!$access['can_manage_all_units']) {
            $unitRules[] = Rule::in($access['allowed_unit_ids']);
        }

        $validated = $request->validate([
            'scout_unit_id' => $unitRules,
            'title' => ['required', 'string', 'max:255'],
            'event_name' => ['nullable', 'string', 'max:255'],
            'media_type' => ['required', 'in:image,video'],
            'media_path' => [$galleryItem ? 'nullable' : 'required_without:media_file', 'nullable', 'string', 'max:255'],
            'media_file' => [$galleryItem ? 'nullable' : 'required_without:media_path', 'nullable', 'file', 'max:51200'],
            'caption' => ['nullable', 'string', 'max:2000'],
            'taken_at' => ['nullable', 'date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->ensureUploadedFileMatchesType($request);

        if ($request->hasFile('media_file')) {
            $validated['media_path'] = $this->storeUploadedFile($request, $galleryItem);
        } elseif ($galleryItem && blank($validated['media_path'] ?? null)) {
            $validated['media_path'] = $galleryItem->media_path;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        unset($validated['media_file']);

        return $validated;
    }

    private function galleryAccess(Request $request): array
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            return [
                'can_manage_all_units' => true,
                'can_manage_global_gallery' => true,
                'allowed_unit_ids' => ScoutUnit::query()->where('is_active', true)->pluck('id')->all(),
            ];
        }

        $member = Member::query()
            ->where('status', 'active')
            ->whereNotNull('email')
            ->whereRaw('LOWER(email) = ?', [strtolower((string) $user->email)])
            ->first();

        if (!$member) {
            abort(403, 'Seuls le chef de groupe et les chefs d unite autorises peuvent publier des photos.');
        }

        if (in_array($member->member_function, self::GROUP_CHIEF_FUNCTIONS, true)) {
            return [
                'can_manage_all_units' => true,
                'can_manage_global_gallery' => true,
                'allowed_unit_ids' => ScoutUnit::query()->where('is_active', true)->pluck('id')->all(),
            ];
        }

        $allowedSlug = self::UNIT_CHIEF_FUNCTION_MAP[$member->member_function] ?? null;

        if (!$allowedSlug) {
            abort(403, 'Seuls le chef de groupe et les chefs d unite autorises peuvent publier des photos.');
        }

        $allowedUnitId = ScoutUnit::query()
            ->where('is_active', true)
            ->where('slug', $allowedSlug)
            ->value('id');

        if (!$allowedUnitId) {
            abort(403, 'Aucune unite autorisee n est rattachee a votre fonction.');
        }

        return [
            'can_manage_all_units' => false,
            'can_manage_global_gallery' => false,
            'allowed_unit_ids' => [$allowedUnitId],
        ];
    }

    private function availableUnits(array $access)
    {
        return ScoutUnit::query()
            ->where('is_active', true)
            ->when(!$access['can_manage_all_units'], fn ($query) => $query->whereIn('id', $access['allowed_unit_ids']))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function ensureSelectedUnitIsAllowed(?int $selectedUnitId, array $access): void
    {
        if (!$selectedUnitId) {
            return;
        }

        if (!in_array($selectedUnitId, $access['allowed_unit_ids'], true)) {
            abort(403, 'Vous ne pouvez gerer que la galerie de votre unite.');
        }
    }

    private function authorizeGalleryItem(GalleryItem $galleryItem, array $access): void
    {
        if ($access['can_manage_all_units']) {
            return;
        }

        if (!$galleryItem->scout_unit_id || !in_array($galleryItem->scout_unit_id, $access['allowed_unit_ids'], true)) {
            abort(403, 'Vous ne pouvez gerer que les photos de votre unite.');
        }
    }

    private function ensureUploadedFileMatchesType(Request $request): void
    {
        if (!$request->hasFile('media_file')) {
            return;
        }

        $mimeType = $request->file('media_file')->getMimeType() ?? '';
        $mediaType = $request->input('media_type');

        if ($mediaType === 'image' && !str_starts_with($mimeType, 'image/')) {
            throw ValidationException::withMessages([
                'media_file' => 'Le fichier choisi doit etre une image.',
            ]);
        }

        if ($mediaType === 'video' && !str_starts_with($mimeType, 'video/')) {
            throw ValidationException::withMessages([
                'media_file' => 'Le fichier choisi doit etre une video.',
            ]);
        }
    }

    private function storeUploadedFile(Request $request, ?GalleryItem $galleryItem = null): string
    {
        $directory = $request->input('media_type') === 'video' ? 'gallery/videos' : 'gallery/images';
        $storedPath = $request->file('media_file')->store($directory, 'public');

        if ($galleryItem) {
            $this->deleteManagedFile($galleryItem->media_path);
        }

        return 'storage/' . $storedPath;
    }

    private function deleteManagedFile(?string $mediaPath): void
    {
        if (!$mediaPath || !str_starts_with($mediaPath, 'storage/gallery/')) {
            return;
        }

        Storage::disk('public')->delete(str_replace('storage/', '', $mediaPath));
    }
}
