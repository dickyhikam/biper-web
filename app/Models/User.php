<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_SUPER_ADMIN = 'super_admin';
    const ROLE_ADMIN = 'admin';
    const ROLE_OWNER = 'owner';
    const ROLE_BIDAN_TERAPIS = 'bidan_terapis';

    const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super Admin',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_OWNER => 'Owner',
        self::ROLE_BIDAN_TERAPIS => 'Bidan / Terapis',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isOwner(): bool
    {
        return $this->role === self::ROLE_OWNER;
    }

    public function isBidanTerapis(): bool
    {
        return $this->role === self::ROLE_BIDAN_TERAPIS;
    }

    public function hasRole(string|array $roles): bool
    {
        if (is_string($roles)) {
            return $this->role === $roles;
        }

        return in_array($this->role, $roles);
    }

    public function bidan(): HasOne
    {
        return $this->hasOne(Bidan::class);
    }

    public function canManageUsers(): bool
    {
        return $this->hasRole([self::ROLE_SUPER_ADMIN, self::ROLE_OWNER]);
    }

    public function canViewUsers(): bool
    {
        return $this->hasRole([self::ROLE_SUPER_ADMIN, self::ROLE_OWNER, self::ROLE_ADMIN]);
    }

    public function canManageBidans(): bool
    {
        return $this->hasRole([self::ROLE_SUPER_ADMIN, self::ROLE_OWNER]);
    }

    public function canViewBidans(): bool
    {
        return $this->hasRole([
            self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN,
            self::ROLE_OWNER, self::ROLE_BIDAN_TERAPIS,
        ]);
    }

    public function getRoleLabelAttribute(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
