<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoutUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'age_range',
        'short_description',
        'long_description',
        'icon',
        'color',
        'accent_color',
        'leader_name',
        'schedule',
        'planned_activities',
        'gender_scope',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'planned_activities' => 'array',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function programEvents()
    {
        return $this->hasMany(ProgramEvent::class);
    }
}
