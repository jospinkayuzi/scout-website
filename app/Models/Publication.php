<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_unit_id',
        'title',
        'type',
        'author',
        'excerpt',
        'body',
        'publication_date',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'publication_date' => 'date',
        'is_published' => 'boolean',
    ];

    public function scoutUnit()
    {
        return $this->belongsTo(ScoutUnit::class);
    }
}
