import { useId, useState } from 'react';

const UNIT_BADGE_STYLES = {
    Route: 'bg-red-600 text-white',
    Amical: 'bg-orange-500 text-white',
    Meute: 'bg-yellow-500 text-white',
    Troupe: 'bg-green-600 text-white',
    Grappe: 'bg-blue-600 text-white',
};

const STATUS_BADGE_STYLES = {
    'En attente': 'bg-amber-100 text-amber-900',
};

function SearchIcon(props) {
    return (
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" {...props}>
            <path
                d="M14.1667 14.1667L17.5 17.5M15.8333 9.16667C15.8333 12.8486 12.8486 15.8333 9.16667 15.8333C5.48477 15.8333 2.5 12.8486 2.5 9.16667C2.5 5.48477 5.48477 2.5 9.16667 2.5C12.8486 2.5 15.8333 5.48477 15.8333 9.16667Z"
                stroke="currentColor"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
            />
        </svg>
    );
}

function UserPlusIcon(props) {
    return (
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" {...props}>
            <path
                d="M10.8333 17.5C10.8333 14.9687 8.22063 12.9167 5 12.9167C1.77934 12.9167 -0.833328 14.9687 -0.833328 17.5M15 6.66667V11.6667M12.5 9.16667H17.5M8.33334 5.83333C8.33334 7.67428 6.84096 9.16667 5 9.16667C3.15906 9.16667 1.66667 7.67428 1.66667 5.83333C1.66667 3.99239 3.15906 2.5 5 2.5C6.84096 2.5 8.33334 3.99239 8.33334 5.83333Z"
                stroke="currentColor"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
            />
        </svg>
    );
}

function PencilIcon(props) {
    return (
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" {...props}>
            <path
                d="M11.6667 3.33333L16.6667 8.33333M2.5 17.5L6.73063 16.5606C7.23327 16.4489 7.69477 16.2018 8.06469 15.8471L16.25 8C17.2175 7.0325 17.2175 5.4675 16.25 4.5L15.5 3.75C14.5325 2.7825 12.9675 2.7825 12 3.75L4.15292 11.9353C3.79821 12.3052 3.55106 12.7667 3.43936 13.2694L2.5 17.5Z"
                stroke="currentColor"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
            />
        </svg>
    );
}

function TrashIcon(props) {
    return (
        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true" {...props}>
            <path
                d="M3.33334 5H16.6667M7.08334 2.5H12.9167M7.91667 9.16667V13.3333M12.0833 9.16667V13.3333M5.83334 5L6.25 15.8333C6.28195 16.664 6.96562 17.3217 7.79688 17.3217H12.2031C13.0344 17.3217 13.7181 16.664 13.75 15.8333L14.1667 5"
                stroke="currentColor"
                strokeWidth="1.5"
                strokeLinecap="round"
                strokeLinejoin="round"
            />
        </svg>
    );
}

function getUnitBadgeClass(unit) {
    return UNIT_BADGE_STYLES[unit] || 'bg-slate-500 text-white';
}

function getStatusBadgeClass(status) {
    return STATUS_BADGE_STYLES[status] || 'bg-slate-100 text-slate-700';
}

export default function MembersTable({
    members = [],
    onAddMember,
    onEditMember,
    onDeleteMember,
}) {
    const searchId = useId();
    const filterId = useId();
    const [searchTerm, setSearchTerm] = useState('');
    const [selectedUnit, setSelectedUnit] = useState('');

    const unitOptions = Array.from(
        new Set(
            members
                .map((member) => member.unite)
                .filter(Boolean)
        )
    ).sort((left, right) => left.localeCompare(right, 'fr'));

    const normalizedSearchTerm = searchTerm.trim().toLowerCase();

    const filteredMembers = members.filter((member) => {
        const matchesUnit = selectedUnit ? member.unite === selectedUnit : true;
        const searchableText = [
            member.nom,
            member.unite,
            member.role,
            member.contact,
            member.statut,
        ]
            .filter(Boolean)
            .join(' ')
            .toLowerCase();
        const matchesSearch = normalizedSearchTerm
            ? searchableText.includes(normalizedSearchTerm)
            : true;

        return matchesUnit && matchesSearch;
    });

    return (
        <div className="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
            <div className="flex flex-col gap-4 border-b border-slate-200 p-4 sm:p-5 lg:flex-row lg:items-center lg:justify-between">
                <div className="flex flex-1 flex-col gap-3 md:flex-row md:items-center">
                    <div className="relative w-full max-w-md">
                        <label htmlFor={searchId} className="sr-only">
                            Rechercher un membre
                        </label>
                        <SearchIcon className="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" />
                        <input
                            id={searchId}
                            type="search"
                            value={searchTerm}
                            onChange={(event) => setSearchTerm(event.target.value)}
                            placeholder="Rechercher..."
                            className="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        />
                    </div>

                    <div className="w-full md:w-64">
                        <label htmlFor={filterId} className="sr-only">
                            Filtrer par unite
                        </label>
                        <select
                            id={filterId}
                            value={selectedUnit}
                            onChange={(event) => setSelectedUnit(event.target.value)}
                            className="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                        >
                            <option value="">Toutes les unites</option>
                            {unitOptions.map((unit) => (
                                <option key={unit} value={unit}>
                                    {unit}
                                </option>
                            ))}
                        </select>
                    </div>
                </div>

                <button
                    type="button"
                    onClick={() => onAddMember?.()}
                    className="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-100"
                >
                    <UserPlusIcon className="h-4 w-4" />
                    <span>Inscrire un membre</span>
                </button>
            </div>

            <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-slate-200">
                    <thead className="bg-slate-50">
                        <tr>
                            <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Nom
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Unite
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Role
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Contact
                            </th>
                            <th className="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Statut
                            </th>
                            <th className="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500 sm:px-5">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody className="divide-y divide-slate-200 bg-white">
                        {filteredMembers.length > 0 ? (
                            filteredMembers.map((member, index) => (
                                <tr
                                    key={`${member.nom}-${member.unite}-${index}`}
                                    className="transition hover:bg-slate-50"
                                >
                                    <td className="whitespace-nowrap px-4 py-4 text-sm font-semibold text-slate-950 sm:px-5">
                                        {member.nom}
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-4 text-sm text-slate-700 sm:px-5">
                                        <span
                                            className={`inline-flex rounded-full px-3 py-1 text-xs font-semibold ${getUnitBadgeClass(
                                                member.unite
                                            )}`}
                                        >
                                            {member.unite}
                                        </span>
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-4 text-sm text-slate-700 sm:px-5">
                                        {member.role}
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-4 text-sm text-slate-700 sm:px-5">
                                        {member.contact || '-'}
                                    </td>
                                    <td className="whitespace-nowrap px-4 py-4 text-sm sm:px-5">
                                        <span
                                            className={`inline-flex rounded-full px-3 py-1 text-xs font-semibold ${getStatusBadgeClass(
                                                member.statut
                                            )}`}
                                        >
                                            {member.statut}
                                        </span>
                                    </td>
                                    <td className="px-4 py-4 sm:px-5">
                                        <div className="flex items-center justify-end gap-2">
                                            <button
                                                type="button"
                                                onClick={() => onEditMember?.(member)}
                                                className="inline-flex h-9 w-9 items-center justify-center rounded-lg text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 focus:outline-none focus:ring-4 focus:ring-slate-100"
                                                aria-label={`Modifier ${member.nom}`}
                                            >
                                                <PencilIcon className="h-4 w-4" />
                                            </button>
                                            <button
                                                type="button"
                                                onClick={() => onDeleteMember?.(member)}
                                                className="inline-flex h-9 w-9 items-center justify-center rounded-lg text-red-500 transition hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-4 focus:ring-red-100"
                                                aria-label={`Supprimer ${member.nom}`}
                                            >
                                                <TrashIcon className="h-4 w-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td
                                    colSpan={6}
                                    className="px-4 py-10 text-center text-sm text-slate-500 sm:px-5"
                                >
                                    Aucun membre ne correspond a votre recherche.
                                </td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
