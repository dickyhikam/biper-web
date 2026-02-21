<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bidan extends Model
{
    use HasFactory;

    const TYPE_FULLTIME = 'fulltime';
    const TYPE_FREELANCE = 'freelance';

    const EMPLOYMENT_TYPES = [
        self::TYPE_FULLTIME => 'Fulltime',
        self::TYPE_FREELANCE => 'Freelance',
    ];

    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'credential',
        'specialization',
        'str_number',
        'experience_years',
        'employment_type',
        'bio',
        'schedule',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'schedule' => 'array',
            'is_active' => 'boolean',
            'experience_years' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute(): string
    {
        $name = $this->user->name ?? '';

        return $this->credential
            ? "{$name}, {$this->credential}"
            : $name;
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->user?->photo_url;
    }
}
