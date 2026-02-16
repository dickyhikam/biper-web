<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bidan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'credential',
        'specialization',
        'phone',
        'str_number',
        'experience_years',
        'photo',
        'bio',
        'address',
        'latitude',
        'longitude',
        'schedule',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'schedule' => 'array',
            'is_active' => 'boolean',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'experience_years' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->credential
            ? "{$this->name}, {$this->credential}"
            : $this->name;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
