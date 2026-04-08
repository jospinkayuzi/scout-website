<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class GalleryItemController extends Controller
{
    public function index()
    {
        $units = ScoutUnit::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $selectedUnitId = request()->integer('scout_unit_id') ?: null;

        $galleryItems = GalleryItem::query()
            ->with('scoutUnit')
            ->when($selectedUnitId, fn ($query) => $query->where('scout_unit_id', $selectedUnitId))
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderByDesc('taken_at')
            ->paginate(18);

        $galleryItems->appends(request()->query());

        return view('admin.gallery-items.index', compact('galleryItems', 'units', 'selectedUnitId'));
    }

    public function create()
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();
        $selectedUnitId = request()->integer('scout_unit_id') ?: null;

        return view('admin.gallery-items.create', compact('units', 'selectedUnitId'));
    }

    public function store(Request $request)
    {
        $galleryItem = GalleryItem::create($this->validatedData($request));

        return redirect()->route('admin.gallery-items.index', array_filter([
            'scout_unit_id' => $galleryItem->scout_unit_id,
        ]))
            ->with('success', 'Media cree avec succes.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.gallery-items.edit', compact('galleryItem', 'units'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $galleryItem->update($this->validatedData($request, $galleryItem));

        return redirect()->route('admin.gallery-items.index', array_filter([
            'scout_unit_id' => $galleryItem->scout_unit_id,
        ]))
            ->with('success', 'Media mis a jour avec succes.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        $this->deleteManagedFile($galleryItem->media_path);
        $galleryItem->delete();

        return redirect()->route('admin.gallery-items.index')
            ->with('success', 'Media supprime avec succes.');
    }

    private function validatedData(Request $request, ?GalleryItem $galleryItem = null): array
    {
        $validated = $request->validate([
            'scout_unit_id' => ['nullable', 'exists:scout_units,id'],
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
