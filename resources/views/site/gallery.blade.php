@extends('site.layouts.app')

@section('title', 'Galerie - Groupe Scout Saint Nicolas')
@section('page_kicker', 'Mediatheque du groupe')
@section('page_title', 'Galerie <span>des unites</span>')
@section('page_summary', 'Une galerie moderne avec filtres, lightbox plein ecran et publication rapide de nouveaux medias.')

@push('styles')
<style>
    .media-gallery {
        display: grid;
        gap: 1.5rem;
    }

    .media-gallery-topbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .media-gallery-tabs {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .media-gallery-tab {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: .55rem;
        padding: .5rem 0;
        border: none;
        background: transparent;
        color: var(--ink-500);
        font: inherit;
        font-size: .95rem;
        font-weight: 700;
        cursor: pointer;
        transition: color .2s ease;
    }

    .media-gallery-tab::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -.15rem;
        height: 2px;
        border-radius: 999px;
        background: currentColor;
        transform: scaleX(0);
        transform-origin: center;
        transition: transform .2s ease;
    }

    .media-gallery-tab:hover,
    .media-gallery-tab.is-active {
        color: var(--navy-950);
    }

    .media-gallery-tab.is-active {
        font-weight: 800;
    }

    .media-gallery-tab.is-active::after {
        transform: scaleX(1);
    }

    .media-gallery-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .media-gallery-publish {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .65rem;
        padding: .92rem 1.2rem;
        border-radius: 14px;
        border: none;
        background: #1e293b;
        color: #fff;
        font: inherit;
        font-size: .92rem;
        font-weight: 700;
        cursor: pointer;
        transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        box-shadow: 0 16px 34px rgba(30, 41, 59, .22);
    }

    .media-gallery-publish:hover {
        background: #0f172a;
        transform: translateY(-1px);
    }

    .media-gallery-publish-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .14);
        font-size: 1rem;
        line-height: 1;
    }

    .media-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 16px;
    }

    .media-card {
        position: relative;
        isolation: isolate;
        min-height: 200px;
        border-radius: 16px;
        overflow: hidden;
        background: linear-gradient(180deg, #dbe4ff 0%, #eff3ff 100%);
        box-shadow: 0 24px 45px rgba(15, 23, 42, .12);
        transform: translateY(26px);
        opacity: 0;
        animation: mediaCardIn .55s ease forwards;
    }

    .media-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, .08) 0%, rgba(15, 23, 42, .24) 100%);
        z-index: 1;
        transition: opacity .25s ease, background .25s ease;
    }

    .media-card:hover::before {
        background: linear-gradient(180deg, rgba(15, 23, 42, .14) 0%, rgba(15, 23, 42, .76) 100%);
    }

    .media-card-asset {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
        transition: transform .45s ease;
    }

    .media-card:hover .media-card-asset {
        transform: scale(1.04);
    }

    .media-card-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .45rem .8rem;
        border-radius: 999px;
        color: #fff;
        font-size: .72rem;
        font-weight: 800;
        letter-spacing: .04em;
        box-shadow: 0 10px 22px rgba(15, 23, 42, .18);
    }

    .media-card-search {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 3;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 50%;
        background: rgba(255, 255, 255, .18);
        color: #fff;
        backdrop-filter: blur(10px);
        cursor: pointer;
        opacity: 0;
        transform: translateY(-8px);
        transition: opacity .25s ease, transform .25s ease, background .25s ease;
    }

    .media-card:hover .media-card-search {
        opacity: 1;
        transform: translateY(0);
    }

    .media-card-search:hover {
        background: rgba(255, 255, 255, .28);
    }

    .media-card-content {
        position: absolute;
        right: 1rem;
        bottom: 1rem;
        left: 1rem;
        z-index: 3;
        display: grid;
        gap: .28rem;
        color: #fff;
        transform: translateY(18px);
        opacity: 0;
        transition: transform .28s ease, opacity .28s ease;
    }

    .media-card:hover .media-card-content {
        transform: translateY(0);
        opacity: 1;
    }

    .media-card-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
    }

    .media-card-date {
        color: rgba(255, 255, 255, .78);
        font-size: .84rem;
        font-weight: 600;
    }

    .media-gallery-empty {
        padding: 3rem 1.5rem;
        border-radius: 20px;
        border: 1px dashed rgba(100, 116, 139, .28);
        background: rgba(255, 255, 255, .72);
        color: var(--ink-500);
        text-align: center;
    }

    .media-modal,
    .publish-modal {
        position: fixed;
        inset: 0;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        z-index: 1200;
    }

    .media-modal.is-open,
    .publish-modal.is-open {
        display: flex;
    }

    .media-modal {
        background: rgba(0, 0, 0, .92);
    }

    .media-modal-close,
    .publish-modal-close,
    .media-modal-nav {
        border: none;
        background: rgba(255, 255, 255, .12);
        color: #fff;
        cursor: pointer;
        backdrop-filter: blur(10px);
        transition: background .2s ease, transform .2s ease;
    }

    .media-modal-close:hover,
    .publish-modal-close:hover,
    .media-modal-nav:hover {
        background: rgba(255, 255, 255, .2);
        transform: translateY(-1px);
    }

    .media-modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        font-size: 1.8rem;
        line-height: 1;
    }

    .media-modal-nav {
        position: absolute;
        top: 50%;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        font-size: 1.6rem;
        line-height: 1;
        transform: translateY(-50%);
    }

    .media-modal-nav:hover {
        transform: translateY(calc(-50% - 1px));
    }

    .media-modal-nav.prev {
        left: 1.25rem;
    }

    .media-modal-nav.next {
        right: 1.25rem;
    }

    .media-modal-stage {
        width: min(1100px, 100%);
        display: grid;
        gap: 1rem;
        justify-items: center;
    }

    .media-modal-asset {
        max-width: 100%;
        max-height: 85vh;
        border-radius: 18px;
        object-fit: contain;
        box-shadow: 0 24px 48px rgba(0, 0, 0, .28);
    }

    .media-modal-footer {
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
        justify-content: center;
        color: #fff;
    }

    .media-modal-category {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .48rem .82rem;
        border-radius: 999px;
        font-size: .76rem;
        font-weight: 800;
        color: #fff;
    }

    .media-modal-title {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1rem;
        font-weight: 700;
    }

    .publish-modal {
        background: rgba(15, 23, 42, .62);
        backdrop-filter: blur(10px);
    }

    .publish-modal-panel {
        width: min(560px, 100%);
        border-radius: 24px;
        background: #fff;
        box-shadow: 0 30px 60px rgba(15, 23, 42, .22);
        overflow: hidden;
    }

    .publish-modal-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.4rem 1.4rem 1rem;
        border-bottom: 1px solid rgba(219, 225, 251, .86);
    }

    .publish-modal-head h3 {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 1.15rem;
        color: var(--navy-950);
    }

    .publish-modal-head p {
        margin-top: .35rem;
        color: var(--ink-500);
        font-size: .9rem;
        line-height: 1.6;
    }

    .publish-modal-close {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(15, 23, 42, .08);
        color: var(--navy-950);
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .publish-form {
        display: grid;
        gap: 1rem;
        padding: 1.4rem;
    }

    .publish-form-row {
        display: grid;
        gap: .5rem;
    }

    .publish-form-row label {
        font-size: .84rem;
        font-weight: 800;
        color: var(--navy-950);
    }

    .publish-form-row input,
    .publish-form-row select {
        width: 100%;
        padding: .92rem 1rem;
        border: 1px solid rgba(203, 213, 225, .95);
        border-radius: 14px;
        font: inherit;
        color: var(--ink-900);
        background: #fff;
        outline: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .publish-form-row input:focus,
    .publish-form-row select:focus {
        border-color: rgba(59, 130, 246, .8);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .12);
    }

    .publish-form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: .75rem;
        flex-wrap: wrap;
        margin-top: .25rem;
    }

    .publish-form-secondary,
    .publish-form-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .85rem 1.15rem;
        border-radius: 14px;
        border: none;
        font: inherit;
        font-size: .9rem;
        font-weight: 700;
        cursor: pointer;
    }

    .publish-form-secondary {
        background: rgba(15, 23, 42, .06);
        color: var(--navy-950);
    }

    .publish-form-primary {
        background: #1e293b;
        color: #fff;
    }

    @keyframes mediaCardIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 1023px) and (min-width: 640px) {
        .media-gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 639px) {
        .media-gallery-grid {
            grid-template-columns: 1fr;
        }

        .media-gallery-topbar {
            align-items: stretch;
        }

        .media-gallery-tabs {
            gap: .8rem;
        }

        .media-gallery-publish {
            width: 100%;
        }

        .media-modal-nav {
            width: 46px;
            height: 46px;
        }

        .media-modal-nav.prev {
            left: .75rem;
        }

        .media-modal-nav.next {
            right: .75rem;
        }
    }
</style>
@endpush

@section('content')
<section>
    <div class="section-shell">
        <div class="media-gallery" id="mediaGallery">
            <div class="media-gallery-topbar">
                <div class="media-gallery-tabs" id="mediaGalleryTabs"></div>
                <button type="button" class="media-gallery-publish" id="openPublishModal">
                    <span class="media-gallery-publish-icon">+</span>
                    <span>Publier un media</span>
                </button>
            </div>

            <div class="media-gallery-grid" id="mediaGalleryGrid"></div>
            <div class="media-gallery-empty" id="mediaGalleryEmpty" hidden>Aucun media ne correspond au filtre selectionne.</div>
        </div>
    </div>
</section>

<div class="media-modal" id="mediaLightbox" aria-hidden="true">
    <button type="button" class="media-modal-close" id="closeLightbox" aria-label="Fermer">&times;</button>
    <button type="button" class="media-modal-nav prev" id="prevMedia" aria-label="Media precedent">&#8249;</button>
    <div class="media-modal-stage">
        <img class="media-modal-asset" id="lightboxImage" alt="" hidden>
        <video class="media-modal-asset" id="lightboxVideo" controls hidden></video>
        <div class="media-modal-footer">
            <span class="media-modal-category" id="lightboxCategory"></span>
            <span class="media-modal-title" id="lightboxTitle"></span>
        </div>
    </div>
    <button type="button" class="media-modal-nav next" id="nextMedia" aria-label="Media suivant">&#8250;</button>
</div>

<div class="publish-modal" id="publishModal" aria-hidden="true">
    <div class="publish-modal-panel">
        <div class="publish-modal-head">
            <div>
                <h3>Publier un media</h3>
                <p>Ajoutez une image ou une video, choisissez la categorie et donnez-lui un titre.</p>
            </div>
            <button type="button" class="publish-modal-close" id="closePublishModal" aria-label="Fermer">&times;</button>
        </div>
        <form class="publish-form" id="publishMediaForm">
            <div class="publish-form-row">
                <label for="mediaFileInput">Uploader une photo ou une video</label>
                <input id="mediaFileInput" name="file" type="file" accept="image/*,video/*" required>
            </div>
            <div class="publish-form-row">
                <label for="mediaCategoryInput">Categorie</label>
                <select id="mediaCategoryInput" name="categorie" required>
                    <option value="">Choisir une categorie</option>
                    <option value="Meute">Meute</option>
                    <option value="Troupe">Troupe</option>
                    <option value="Grappe">Grappe</option>
                    <option value="Route">Route</option>
                    <option value="Amical">Amical</option>
                </select>
            </div>
            <div class="publish-form-row">
                <label for="mediaTitleInput">Titre</label>
                <input id="mediaTitleInput" name="titre" type="text" placeholder="Ex. Camp de la Meute" required>
            </div>
            <div class="publish-form-actions">
                <button type="button" class="publish-form-secondary" id="cancelPublishModal">Annuler</button>
                <button type="submit" class="publish-form-primary">Publier</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabsContainer = document.getElementById('mediaGalleryTabs');
    const grid = document.getElementById('mediaGalleryGrid');
    const emptyState = document.getElementById('mediaGalleryEmpty');
    const lightbox = document.getElementById('mediaLightbox');
    const closeLightboxButton = document.getElementById('closeLightbox');
    const prevMediaButton = document.getElementById('prevMedia');
    const nextMediaButton = document.getElementById('nextMedia');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxVideo = document.getElementById('lightboxVideo');
    const lightboxCategory = document.getElementById('lightboxCategory');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const publishModal = document.getElementById('publishModal');
    const openPublishModalButton = document.getElementById('openPublishModal');
    const closePublishModalButton = document.getElementById('closePublishModal');
    const cancelPublishModalButton = document.getElementById('cancelPublishModal');
    const publishMediaForm = document.getElementById('publishMediaForm');
    const mediaFileInput = document.getElementById('mediaFileInput');
    const mediaCategoryInput = document.getElementById('mediaCategoryInput');
    const mediaTitleInput = document.getElementById('mediaTitleInput');

    const categoryColors = {
        Toutes: '#64748b',
        Meute: '#f59e0b',
        Troupe: '#10b981',
        Grappe: '#3b82f6',
        Route: '#ef4444',
        Amical: '#8b5cf6',
    };

    const filters = ['Toutes', 'Meute', 'Troupe', 'Grappe', 'Route', 'Amical'];

    const sampleMedia = [
        { id: 1, url: 'https://picsum.photos/seed/1/600/400', type: 'image', categorie: 'Meute', titre: 'Camp orange au lever du jour', date: '12 mai 2026' },
        { id: 2, url: 'https://picsum.photos/seed/2/600/400', type: 'image', categorie: 'Troupe', titre: 'Grand jeu dans la foret', date: '17 mai 2026' },
        { id: 3, url: 'https://picsum.photos/seed/3/600/400', type: 'image', categorie: 'Grappe', titre: 'Atelier projet et expression', date: '20 mai 2026' },
        { id: 4, url: 'https://picsum.photos/seed/4/600/400', type: 'image', categorie: 'Route', titre: 'Depart en mission de service', date: '26 mai 2026' },
        { id: 5, url: 'https://picsum.photos/seed/5/600/400', type: 'image', categorie: 'Amical', titre: 'Rencontre des anciens', date: '29 mai 2026' },
        { id: 6, url: 'https://picsum.photos/seed/6/600/400', type: 'image', categorie: 'Meute', titre: 'Chants autour du feu', date: '02 juin 2026' },
    ];

    const cardHeights = [200, 224, 248, 280, 232, 260];
    let mediaItems = sampleMedia.slice();
    let activeFilter = 'Toutes';
    let filteredItems = mediaItems.slice();
    let activeIndex = 0;

    function getBadgeColor(category) {
        return categoryColors[category] || '#64748b';
    }

    function buildTabs() {
        tabsContainer.innerHTML = '';

        filters.forEach(function (filterName) {
            const button = document.createElement('button');
            const dot = document.createElement('span');
            const label = document.createElement('span');

            button.type = 'button';
            button.className = 'media-gallery-tab' + (filterName === activeFilter ? ' is-active' : '');
            button.setAttribute('data-filter', filterName);

            dot.className = 'media-gallery-dot';
            dot.style.backgroundColor = getBadgeColor(filterName);

            label.textContent = filterName;

            button.appendChild(dot);
            button.appendChild(label);
            button.addEventListener('click', function () {
                activeFilter = filterName;
                renderGallery();
            });

            tabsContainer.appendChild(button);
        });
    }

    function getVisibleItems() {
        if (activeFilter === 'Toutes') {
            return mediaItems.slice();
        }

        return mediaItems.filter(function (item) {
            return item.categorie === activeFilter;
        });
    }

    function openLightbox(index) {
        filteredItems = getVisibleItems();
        activeIndex = index;
        renderLightbox();
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        lightboxVideo.pause();
        lightboxVideo.removeAttribute('src');
        lightboxVideo.load();
        document.body.style.overflow = '';
    }

    function renderLightbox() {
        const item = filteredItems[activeIndex];

        if (!item) {
            closeLightbox();
            return;
        }

        lightboxCategory.textContent = item.categorie;
        lightboxCategory.style.backgroundColor = getBadgeColor(item.categorie);
        lightboxTitle.textContent = item.titre;

        if (item.type === 'video') {
            lightboxVideo.src = item.url;
            lightboxVideo.hidden = false;
            lightboxImage.hidden = true;
        } else {
            lightboxImage.src = item.url;
            lightboxImage.alt = item.titre;
            lightboxImage.hidden = false;
            lightboxVideo.hidden = true;
            lightboxVideo.pause();
            lightboxVideo.removeAttribute('src');
            lightboxVideo.load();
        }
    }

    function renderGallery() {
        filteredItems = getVisibleItems();
        buildTabs();
        grid.innerHTML = '';
        emptyState.hidden = filteredItems.length > 0;

        filteredItems.forEach(function (item, index) {
            const article = document.createElement('article');
            const asset = document.createElement(item.type === 'video' ? 'video' : 'img');
            const badge = document.createElement('span');
            const searchButton = document.createElement('button');
            const content = document.createElement('div');
            const title = document.createElement('div');
            const date = document.createElement('div');

            article.className = 'media-card';
            article.style.height = cardHeights[index % cardHeights.length] + 'px';
            article.style.animationDelay = (index * 70) + 'ms';

            asset.className = 'media-card-asset';
            asset.src = item.url;

            if (item.type === 'video') {
                asset.muted = true;
                asset.loop = true;
                asset.playsInline = true;
                asset.autoplay = true;
            } else {
                asset.alt = item.titre;
            }

            badge.className = 'media-card-badge';
            badge.style.backgroundColor = getBadgeColor(item.categorie);
            badge.textContent = item.categorie;

            searchButton.type = 'button';
            searchButton.className = 'media-card-search';
            searchButton.setAttribute('aria-label', 'Ouvrir ' + item.titre);
            searchButton.innerHTML = '<svg viewBox="0 0 20 20" width="18" height="18" fill="none" aria-hidden="true"><path d="M14.1667 14.1667L17.5 17.5M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            searchButton.addEventListener('click', function (event) {
                event.stopPropagation();
                openLightbox(index);
            });

            content.className = 'media-card-content';
            title.className = 'media-card-title';
            date.className = 'media-card-date';
            title.textContent = item.titre;
            date.textContent = item.date;
            content.appendChild(title);
            content.appendChild(date);

            article.appendChild(asset);
            article.appendChild(badge);
            article.appendChild(searchButton);
            article.appendChild(content);
            article.addEventListener('click', function () {
                openLightbox(index);
            });

            grid.appendChild(article);
        });
    }

    function openPublishModal() {
        publishModal.classList.add('is-open');
        publishModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closePublishModal() {
        publishModal.classList.remove('is-open');
        publishModal.setAttribute('aria-hidden', 'true');
        publishMediaForm.reset();
        if (!lightbox.classList.contains('is-open')) {
            document.body.style.overflow = '';
        }
    }

    openPublishModalButton.addEventListener('click', openPublishModal);
    closePublishModalButton.addEventListener('click', closePublishModal);
    cancelPublishModalButton.addEventListener('click', closePublishModal);

    publishModal.addEventListener('click', function (event) {
        if (event.target === publishModal) {
            closePublishModal();
        }
    });

    lightbox.addEventListener('click', function (event) {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    closeLightboxButton.addEventListener('click', closeLightbox);

    prevMediaButton.addEventListener('click', function () {
        if (!filteredItems.length) {
            return;
        }

        activeIndex = (activeIndex - 1 + filteredItems.length) % filteredItems.length;
        renderLightbox();
    });

    nextMediaButton.addEventListener('click', function () {
        if (!filteredItems.length) {
            return;
        }

        activeIndex = (activeIndex + 1) % filteredItems.length;
        renderLightbox();
    });

    document.addEventListener('keydown', function (event) {
        if (lightbox.classList.contains('is-open')) {
            if (event.key === 'Escape') {
                closeLightbox();
            }

            if (event.key === 'ArrowLeft') {
                prevMediaButton.click();
            }

            if (event.key === 'ArrowRight') {
                nextMediaButton.click();
            }
        }

        if (publishModal.classList.contains('is-open') && event.key === 'Escape') {
            closePublishModal();
        }
    });

    publishMediaForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const file = mediaFileInput.files[0];
        const category = mediaCategoryInput.value;
        const title = mediaTitleInput.value.trim();

        if (!file || !category || !title) {
            return;
        }

        const type = file.type.startsWith('video/') ? 'video' : 'image';
        const item = {
            id: Date.now(),
            url: URL.createObjectURL(file),
            type: type,
            categorie: category,
            titre: title,
            date: new Date().toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
            }),
        };

        mediaItems.unshift(item);
        renderGallery();
        closePublishModal();
    });

    renderGallery();
});
</script>
@endpush
