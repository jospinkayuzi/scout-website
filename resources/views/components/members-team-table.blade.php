@props([
    'members' => [],
    'title' => 'Champ des membres',
    'summary' => "Un tableau de demonstration pour une application de gestion d'equipes, avec recherche et filtre par unite.",
])

@php
    $tableId = 'members-team-table-' . \Illuminate\Support\Str::uuid();
    $units = collect($members)
        ->pluck('unite')
        ->filter()
        ->unique()
        ->sort()
        ->values();
    $unitStyles = [
        'Route' => 'background:#dc2626;color:#fff;',
        'Amical' => 'background:#f97316;color:#fff;',
        'Meute' => 'background:#eab308;color:#111827;',
        'Troupe' => 'background:#16a34a;color:#fff;',
        'Troupe F' => 'background:#16a34a;color:#fff;',
        'Troupe M' => 'background:#15803d;color:#fff;',
        'Grappe' => 'background:#2563eb;color:#fff;',
    ];
    $statusStyles = [
        'En attente' => 'background:#fef3c7;color:#9a3412;',
        'Actif' => 'background:#dcfce7;color:#166534;',
        'Inactif' => 'background:#e5e7eb;color:#374151;',
    ];
@endphp

@once
    @push('styles')
        <style>
            .team-members-card {
                overflow: hidden;
            }

            .team-members-tools {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                flex-wrap: wrap;
                margin-bottom: 1.4rem;
            }

            .team-members-filters {
                display: flex;
                gap: .9rem;
                flex: 1 1 560px;
                flex-wrap: wrap;
            }

            .team-members-field {
                position: relative;
                flex: 1 1 260px;
            }

            .team-members-icon {
                position: absolute;
                top: 50%;
                left: 1rem;
                width: 18px;
                height: 18px;
                transform: translateY(-50%);
                color: #94a3b8;
                pointer-events: none;
            }

            .team-members-input,
            .team-members-select {
                width: 100%;
                min-height: 50px;
                border: 1px solid rgba(148, 163, 184, .3);
                border-radius: 16px;
                background: #fff;
                color: var(--navy-950);
                font: inherit;
                font-size: .95rem;
                outline: none;
                transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
            }

            .team-members-input {
                padding: .9rem 1rem .9rem 2.9rem;
            }

            .team-members-select {
                padding: .9rem 1rem;
                appearance: none;
            }

            .team-members-input:focus,
            .team-members-select:focus {
                border-color: rgba(37, 99, 235, .55);
                box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
            }

            .team-members-shell {
                border: 1px solid rgba(148, 163, 184, .18);
                border-radius: 22px;
                overflow: hidden;
                background: linear-gradient(180deg, rgba(255, 255, 255, .98), rgba(248, 250, 252, .98));
            }

            .team-members-table-wrap {
                overflow-x: auto;
            }

            .team-members-table {
                width: 100%;
                border-collapse: collapse;
                min-width: 720px;
            }

            .team-members-table thead {
                background: #f8fafc;
            }

            .team-members-table th,
            .team-members-table td {
                padding: 1rem 1.15rem;
                border-bottom: 1px solid rgba(226, 232, 240, .9);
                text-align: left;
                vertical-align: middle;
            }

            .team-members-table th {
                color: #64748b;
                font-size: .74rem;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .team-members-table tbody tr {
                transition: background .2s ease;
            }

            .team-members-table tbody tr:hover {
                background: rgba(248, 250, 252, .88);
            }

            .team-members-name {
                font-weight: 800;
                color: var(--navy-950);
            }

            .team-members-cell {
                color: var(--ink-500);
                font-size: .94rem;
            }

            .team-members-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: .35rem;
                padding: .45rem .9rem;
                border-radius: 999px;
                font-size: .78rem;
                font-weight: 800;
                line-height: 1;
                white-space: nowrap;
            }

            .team-members-empty {
                padding: 1.4rem 1.15rem;
                text-align: center;
                color: #64748b;
                font-size: .92rem;
            }

            @media (max-width: 720px) {
                .team-members-tools {
                    align-items: stretch;
                }

                .team-members-filters {
                    flex-direction: column;
                }
            }
        </style>
    @endpush
@endonce

<article class="callout-card team-members-card" id="{{ $tableId }}">
    <div class="section-head">
        <h2 class="section-title">{{ $title }}</h2>
        <p class="section-copy">{{ $summary }}</p>
    </div>

    <div class="team-members-tools">
        <div class="team-members-filters">
            <div class="team-members-field">
                <svg class="team-members-icon" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                    <path d="M14.1667 14.1667L17.5 17.5M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input
                    type="search"
                    class="team-members-input"
                    placeholder="Rechercher..."
                    data-members-search
                    aria-label="Rechercher un membre"
                >
            </div>

            <div class="team-members-field">
                <select class="team-members-select" data-members-filter aria-label="Filtrer par unite">
                    <option value="">Toutes les unit&eacute;s</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit }}">{{ $unit }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="team-members-shell">
        <div class="team-members-table-wrap">
            <table class="team-members-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Unit&eacute;</th>
                        <th>R&ocirc;le</th>
                        <th>Contact</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody data-members-body>
                    @foreach($members as $member)
                        @php
                            $searchIndex = strtolower(implode(' ', array_filter([
                                $member['nom'] ?? '',
                                $member['unite'] ?? '',
                                $member['role'] ?? '',
                                $member['contact'] ?? '',
                                $member['statut'] ?? '',
                            ])));
                        @endphp
                        <tr data-member-row data-member-unit="{{ $member['unite'] ?? '' }}" data-member-search="{{ $searchIndex }}">
                            <td class="team-members-name">{{ $member['nom'] ?? '-' }}</td>
                            <td class="team-members-cell">
                                <span class="team-members-badge" style="{{ $unitStyles[$member['unite'] ?? ''] ?? 'background:#475569;color:#fff;' }}">
                                    {{ $member['unite'] ?? '-' }}
                                </span>
                            </td>
                            <td class="team-members-cell">{{ $member['role'] ?? '-' }}</td>
                            <td class="team-members-cell">{{ $member['contact'] ?: '-' }}</td>
                            <td class="team-members-cell">
                                <span class="team-members-badge" style="{{ $statusStyles[$member['statut'] ?? ''] ?? 'background:#e2e8f0;color:#334155;' }}">
                                    {{ $member['statut'] ?? '-' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <tr data-members-empty hidden>
                        <td colspan="5" class="team-members-empty">Aucun membre ne correspond &agrave; votre recherche.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</article>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('[id^="members-team-table-"]').forEach(function (tableRoot) {
                    const searchInput = tableRoot.querySelector('[data-members-search]');
                    const unitFilter = tableRoot.querySelector('[data-members-filter]');
                    const rows = Array.from(tableRoot.querySelectorAll('[data-member-row]'));
                    const emptyRow = tableRoot.querySelector('[data-members-empty]');

                    function normalize(value) {
                        return (value || '').toLowerCase().trim();
                    }

                    function filterRows() {
                        const searchTerm = normalize(searchInput.value);
                        const selectedUnit = unitFilter.value;
                        let visibleCount = 0;

                        rows.forEach(function (row) {
                            const matchesSearch = searchTerm
                                ? row.dataset.memberSearch.includes(searchTerm)
                                : true;
                            const matchesUnit = selectedUnit
                                ? row.dataset.memberUnit === selectedUnit
                                : true;
                            const isVisible = matchesSearch && matchesUnit;

                            row.hidden = !isVisible;

                            if (isVisible) {
                                visibleCount += 1;
                            }
                        });

                        emptyRow.hidden = visibleCount > 0;
                    }

                    searchInput.addEventListener('input', filterRows);
                    unitFilter.addEventListener('change', filterRows);
                    filterRows();
                });
            });
        </script>
    @endpush
@endonce
