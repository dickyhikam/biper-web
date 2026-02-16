<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    const ROLE_PELANGGAN = 'pelanggan';

    const ROLES = [
        self::ROLE_SUPER_ADMIN => 'Super Admin',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_OWNER => 'Owner',
        self::ROLE_BIDAN_TERAPIS => 'Bidan / Terapis',
        self::ROLE_PELANGGAN => 'Pelanggan',
    ];

    const NICKNAMES = ['Bunda', 'Ibu', 'Mom', 'Mama'];

    protected $fillable = [
        'name',
        'nickname',
        'email',
        'phone',
        'password',
        'role',
        'email_verification_code',
        'email_verification_code_expires_at',
        'email_verification_code_sent_at',
        'email_verification_attempts',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'email_verification_code_expires_at' => 'datetime',
            'email_verification_code_sent_at' => 'datetime',
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

    public function isPelanggan(): bool
    {
        return $this->role === self::ROLE_PELANGGAN;
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

    public function anaks(): HasMany
    {
        return $this->hasMany(Anak::class);
    }

    public function needsChildData(): bool
    {
        return $this->isPelanggan() && $this->hasVerifiedEmail() && $this->anaks()->count() === 0;
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

    public function canManageSlides(): bool
    {
        return $this->hasRole([self::ROLE_SUPER_ADMIN, self::ROLE_OWNER]);
    }

    public function canViewSlides(): bool
    {
        return $this->hasRole([self::ROLE_SUPER_ADMIN, self::ROLE_ADMIN, self::ROLE_OWNER]);
    }

    public function generateVerificationCode(): string
    {
        $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        $this->update([
            'email_verification_code' => $code,
            'email_verification_code_expires_at' => now()->addMinutes(15),
            'email_verification_code_sent_at' => now(),
        ]);

        return $code;
    }

    public function verifyEmailWithCode(string $code): bool
    {
        if ($this->email_verification_code !== strtoupper(trim($code))) {
            return false;
        }

        if ($this->email_verification_code_expires_at->lt(now())) {
            return false;
        }

        $this->update([
            'email_verified_at' => now(),
            'email_verification_code' => null,
            'email_verification_code_expires_at' => null,
            'email_verification_attempts' => 0,
        ]);

        return true;
    }

    public function canResendVerificationCode(): bool
    {
        if ($this->email_verification_code_sent_at &&
            $this->email_verification_code_sent_at->gt(now()->subMinute())) {
            return false;
        }

        if ($this->email_verification_code_sent_at &&
            $this->email_verification_code_sent_at->lt(now()->subHour())) {
            $this->update(['email_verification_attempts' => 0]);
        }

        return $this->email_verification_attempts < 3;
    }

    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    public function needsEmailVerification(): bool
    {
        return $this->isPelanggan() && !$this->hasVerifiedEmail();
    }

    public function getRoleLabelAttribute(): string
    {
        return self::ROLES[$this->role] ?? $this->role;
    }
}
