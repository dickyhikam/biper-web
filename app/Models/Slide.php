<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Slide extends Model
{
    use HasFactory;

    const OVERLAY_COLORS = [
        'pink' => 'from-biper-pink/90',
        'blue' => 'from-biper-blue/90',
        'dark' => 'from-gray-900/90',
    ];

    const OVERLAY_LABELS = [
        'pink' => 'Pink',
        'blue' => 'Blue',
        'dark' => 'Dark',
    ];

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'cta_text',
        'cta_link',
        'overlay_color',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getOverlayClassAttribute(): string
    {
        return self::OVERLAY_COLORS[$this->overlay_color] ?? self::OVERLAY_COLORS['pink'];
    }
}
