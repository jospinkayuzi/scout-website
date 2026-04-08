@extends('site.layouts.app')

@section('title', 'Galerie - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Souvenirs et moments forts')
@section('page_title', 'La galerie du groupe')
@section('page_summary', 'Les photos et videos publiees pour les unites et pour le groupe sont maintenant visibles sur une page publique claire et facile a parcourir.')

@push('styles')
<style>
    .gallery-unit-nav {
        display: flex;
        flex-wrap: wrap;
        gap: .75rem;
    }

    .gallery-unit-link {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .75rem 1rem;
        border-radius: 999px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .98), rgba(248, 250, 255, .96));
        border: 1px solid rgba(219, 225, 251, .95);
        color: var(--navy-900);
        font-size: .82rem;
        font-weight: 800;
        box-shadow: 0 14px 28px rgba(35, 40, 122, .08);
    }

    .gallery-unit-link:hover {
        transform: translateY(-1px);
        box-shadow: 0 18px 34px rgba(35, 40, 122, .12);
    }

    .gallery-unit-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px;
        min-height: 28px;
        padding: 0 .45rem;
        border-radius: 999px;
        background: rgba(33, 75, 143, .08);
        color: var(--navy-950);
        font-size: .75rem;
    }

    .gallery-group + .gallery-group {
        margin-top: 1.8rem;
    }

    .gallery-group-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }

    .gallery-group-meta {
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .55rem .9rem;
        border-radius: 999px;
        background: rgba(33, 75, 143, .06);
        color: var(--ink-500);
        font-size: .8rem;
        font-weight: 700;
    }
</style>
@endpush

@section('content')
@php
    $galleryGroups = [];

    foreach ($galleryItems as $galleryItem) {
        $scoutUnit = $galleryItem->scoutUnit;
        $groupName = $scoutUnit ? $scoutUnit->name : 'Groupe';

        if (!array_key_exists($groupName, $galleryGroups)) {
            $galleryGroups[$groupName] = [
                'name' => $groupName,
                'title' => $groupName === 'Groupe' ? 'Groupe - Evenements du groupe' : $groupName,
                'anchor' => 'galerie-' . \Illuminate\Support\Str::slug($groupName),
                'sort_order' => $scoutUnit ? (int) ($scoutUnit->sort_order ?? 0) : PHP_INT_MAX,
                'items' => [],
            ];
        }

        $galleryGroups[$groupName]['items'][] = $galleryItem;
    }

    uasort($galleryGroups, function ($left, $right) {
        if ($left['sort_order'] === $right['sort_order']) {
            return strcmp($left['name'], $right['name']);
        }

        return $left['sort_order'] <=> $right['sort_order'];
    });
@endphp

@if($featuredGalleryItems->isNotEmpty())
    <section>
        <div class="section-shell">
            <div class="section-head">
                <h2 class="section-title">Mises en <span>avant</span></h2>
            </div>
            <div class="gallery-grid">
                @foreach($featuredGalleryItems as $featuredItem)
                    @php
                        $featuredMediaPath = \Illuminate\Support\Str::startsWith($featuredItem->media_path, ['http://', 'https://'])
                            ? $featuredItem->media_path
                            : asset($featuredItem->media_path);
                        $featuredUnitName = $featuredItem->scoutUnit ? $featuredItem->scoutUnit->name : 'Groupe';
                    @endphp
                    <article class="gallery-card" onclick="openGalleryModal('{{ $featuredMediaPath }}', '{{ $featuredItem->title }}', '{{ $featuredItem->media_type }}')">
                        <div class="gallery-media">
                            @if($featuredItem->media_type === 'video')
                                <video controls preload="metadata">
                                    <source src="{{ $featuredMediaPath }}">
                                </video>
                            @else
                                <img src="{{ $featuredMediaPath }}" alt="{{ $featuredItem->title }}">
                            @endif
                        </div>
                        <div class="gallery-body">
                            <div class="card-title">{{ $featuredItem->title }}</div>
                            <p class="card-copy">{{ $featuredItem->caption ?: 'Moment fort du groupe scout.' }}</p>
                            <div class="meta-row">
                                <span class="pill">{{ $featuredUnitName }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if(!empty($galleryGroups))
    <section>
        <div class="section-shell">
            <div class="section-head">
                <h2 class="section-title">Galeries par <span>unite</span></h2>
                <p class="section-copy">Choisissez une unite pour voir rapidement ses photos et videos publiees sur le site.</p>
            </div>
            <div class="gallery-unit-nav">
                @foreach($galleryGroups as $galleryGroup)
                    <a href="#{{ $galleryGroup['anchor'] }}" class="gallery-unit-link">
                        {{ $galleryGroup['name'] }}
                        <span class="gallery-unit-count">{{ count($galleryGroup['items']) }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section>
    <div class="section-shell">
        <div class="section-head">
            <h2 class="section-title">Tous les <span>medias</span></h2>
        </div>

        @forelse($galleryGroups as $galleryGroup)
            <section class="gallery-group" id="{{ $galleryGroup['anchor'] }}">
                <div class="gallery-group-head">
                    <div class="section-head" style="margin:0;">
                        <h3 class="section-title" style="font-size:1.3rem; margin:0;">{{ $galleryGroup['title'] }}</h3>
                    </div>
                    <div class="gallery-group-meta">
                        <i class="fa-solid fa-images"></i>
                        <span>{{ count($galleryGroup['items']) }} media{{ count($galleryGroup['items']) > 1 ? 's' : '' }}</span>
                    </div>
                </div>
                <div class="gallery-grid">
                    @foreach($galleryGroup['items'] as $galleryItem)
                        @php
                            $galleryMediaPath = \Illuminate\Support\Str::startsWith($galleryItem->media_path, ['http://', 'https://'])
                                ? $galleryItem->media_path
                                : asset($galleryItem->media_path);
                            $galleryUnitName = $galleryItem->scoutUnit ? $galleryItem->scoutUnit->name : 'Groupe';
                            $galleryEventLabel = null;

                            if (!empty($galleryItem->event_name)) {
                                $galleryEventLabel = $galleryItem->event_name;

                                if (!$galleryItem->scoutUnit) {
                                    $galleryEventLabel .= ' - Evenement du groupe';
                                }
                            }
                        @endphp
                        <article class="gallery-card" onclick="openGalleryModal('{{ $galleryMediaPath }}', '{{ $galleryItem->title }}', '{{ $galleryItem->media_type }}')">
                            <div class="gallery-media">
                                @if($galleryItem->media_type === 'video')
                                    <video controls preload="metadata">
                                        <source src="{{ $galleryMediaPath }}">
                                    </video>
                                @else
                                    <img src="{{ $galleryMediaPath }}" alt="{{ $galleryItem->title }}">
                                @endif
                            </div>
                            <div class="gallery-body">
                                <div class="card-title">{{ $galleryItem->title }}</div>
                                <p class="card-copy">{{ $galleryItem->caption ?: 'Souvenir du groupe scout.' }}</p>
                                <div class="meta-row">
                                    <span class="pill">{{ $galleryUnitName }}</span>
                                    @if($galleryEventLabel)
                                        <span class="pill">{{ $galleryEventLabel }}</span>
                                    @endif
                                    @if($galleryItem->taken_at)
                                        <span class="pill">{{ $galleryItem->taken_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="empty-state">Aucun media public pour le moment.</div>
        @endforelse
    </div>
</section>

<div id="galleryModal" class="gallery-modal" style="display: none;">
    <div class="gallery-modal-content">
        <span class="gallery-modal-close" onclick="closeGalleryModal()">&times;</span>
        <div class="gallery-modal-media">
            <img id="modalImage" src="" alt="" style="display: none;">
            <video id="modalVideo" controls style="display: none;"></video>
        </div>
        <div class="gallery-modal-caption">
            <h3 id="modalTitle"></h3>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openGalleryModal(mediaPath, title, mediaType) {
    const modal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('modalImage');
    const modalVideo = document.getElementById('modalVideo');
    const modalTitle = document.getElementById('modalTitle');

    modalTitle.textContent = title;

    if (mediaType === 'video') {
        modalVideo.src = mediaPath;
        modalVideo.style.display = 'block';
        modalImage.style.display = 'none';
    } else {
        modalImage.src = mediaPath;
        modalImage.alt = title;
        modalImage.style.display = 'block';
        modalVideo.style.display = 'none';
    }

    modal.style.display = 'flex';
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    const modalVideo = document.getElementById('modalVideo');

    modal.style.display = 'none';
    modalVideo.pause();
    modalVideo.src = '';
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('galleryModal');

    if (!modal) {
        return;
    }

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeGalleryModal();
        }
    });
});
</script>
@endpush
