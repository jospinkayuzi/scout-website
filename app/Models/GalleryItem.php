<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_unit_id',
        'title',
        'event_name',
        'media_type',
        'media_path',
        'caption',
        'taken_at',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'taken_at' => 'date',
        'is_featured' => 'boolean',
    ];

    public function scoutUnit()
    {
        return $this->belongsTo(ScoutUnit::class);
    }
}
