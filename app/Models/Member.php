<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_unit_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'gender',
        'address',
        'parent_name',
        'medical_notes',
        'motivation',
        'status',
        'member_function',
        'role_title',
        'registered_at',
        'approved_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'registered_at' => 'date',
        'approved_at' => 'datetime',
    ];

    protected $appends = [
        'full_name',
        'age',
    ];

    public function scoutUnit()
    {
        return $this->belongsTo(ScoutUnit::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getAgeAttribute(): ?int
    {
        return $this->birth_date?->age;
    }
}
