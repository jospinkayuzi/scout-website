<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_unit_id',
        'title',
        'description',
        'event_date',
        'time_label',
        'responsible',
        'location',
        'sort_order',
        'is_public',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_public' => 'boolean',
    ];

    public function scoutUnit()
    {
        return $this->belongsTo(ScoutUnit::class);
    }
}
