<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\ScoutUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query()
            ->with('scoutUnit')
            ->orderByDesc('registered_at')
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('type') && $request->input('type') === 'maitrise') {
            $maitriseFunctions = [
                'Cheffe de Groupe',
                'Assistant chef de groupe',
                'Secrétaire',
                'Trésorier(e)',
                'Akela (Chef d\'unité Meute)',
                'Baghera (Assistants)',
                'Baloo',
                'Troupe F',
                'Troupe M',
                'Grappe',
                'Amical',
                'Disciplinaire',
                'Chargé du matériel',
                'Chargée du social',
                'Chargé de la communication',
                'Animation du groupe',
                'Chargé de la spiritualité',
                'Chargé des projets, partenariats et développement du groupe',
                'Chargé des événements et de l\'expression des talents',
            ];
            $query->whereIn('member_function', $maitriseFunctions);
        }

        $members = $query->paginate(15)->withQueryString();
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.members.index', compact('members', 'units'));
    }

    public function create()
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.members.create', compact('units'));
    }

    public function store(Request $request)
    {
        Member::create($this->validatedData($request));

        return redirect()->route('admin.members.index')
            ->with('success', 'Membre cree avec succes.');
    }

    public function edit(Member $member)
    {
        $units = ScoutUnit::query()->where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.members.edit', compact('member', 'units'));
    }

    public function update(Request $request, Member $member)
    {
        $member->update($this->validatedData($request, $member));

        return redirect()->route('admin.members.index')
            ->with('success', 'Membre mis a jour avec succes.');
    }

    public function approve(Member $member)
    {
        $member->update([
            'status' => 'active',
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Membre approuve avec succes.');
    }

    public function reject(Member $member)
    {
        $member->update([
            'status' => 'inactive',
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Membre rejete avec succes.');
    }

    public function reactivate(Member $member)
    {
        $member->update([
            'status' => 'active',
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Membre reactive avec succes.');
    }

    public function promoteToMaitrise(Request $request, Member $member)
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Seul le super admin peut promouvoir un membre à la maîtrise.');
        }

        $validated = $request->validate([
            'member_function' => ['required', 'string', 'in:Cheffe de Groupe,Assistant chef de groupe,Secrétaire,Trésorier(e),Akela (Chef d\'unité Meute),Baghera (Assistants),Baloo,Troupe F,Troupe M,Grappe,Amical,Disciplinaire,Chargé du matériel,Chargée du social,Chargé de la communication,Animation du groupe,Chargé de la spiritualité,Chargé des projets, partenariats et développement du groupe,Chargé des événements et de l\'expression des talents'],
        ]);

        $member->update($validated);

        return redirect()->route('admin.members.index')
            ->with('success', $member->full_name . ' a été promu à la maîtrise en tant que ' . $validated['member_function'] . '.');
    }

    private function validatedData(Request $request, ?Member $member = null): array
    {
        $validated = $request->validate([
            'scout_unit_id' => ['required', 'exists:scout_units,id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'birth_date' => ['required', 'date', 'before_or_equal:today'],
            'gender' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:1000'],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'medical_notes' => ['nullable', 'string', 'max:2000'],
            'motivation' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'in:active,pending,inactive'],
            'member_function' => ['nullable', 'string', 'max:255'],
            'role_title' => ['nullable', 'string', 'max:255'],
            'registered_at' => ['nullable', 'date'],
        ]);

        $unit = ScoutUnit::findOrFail($validated['scout_unit_id']);
        $this->enforceUnitRules($unit, $validated);

        $validated['approved_at'] = $validated['status'] === 'active'
            ? ($member?->approved_at ?? now())
            : null;
        $validated['registered_at'] = $validated['registered_at'] ?? now()->toDateString();

        return $validated;
    }

    private function enforceUnitRules(ScoutUnit $unit, array $validated): void
    {
        if (in_array($unit->slug, ['meute', 'troupe-f', 'troupe-m', 'grappe'], true) && blank($validated['parent_name'] ?? null)) {
            throw ValidationException::withMessages([
                'parent_name' => 'Le parent ou tuteur est obligatoire pour cette unite.',
            ]);
        }

        if (in_array($unit->slug, ['route', 'amical'], true) && blank($validated['phone'] ?? null)) {
            throw ValidationException::withMessages([
                'phone' => 'Le telephone est obligatoire pour cette unite.',
            ]);
        }
    }
}
