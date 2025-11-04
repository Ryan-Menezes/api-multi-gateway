<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hasRoleAdmin(): bool
    {
        return $this->role == UserRoleEnum::ADMIN->value;
    }

    public function hasRoleManager(): bool
    {
        return $this->role == UserRoleEnum::MANAGER->value;
    }

    public function hasRoleFinance(): bool
    {
        return $this->role == UserRoleEnum::FINANCE->value;
    }

    public function hasRoleUser(): bool
    {
        return $this->role == UserRoleEnum::USER->value;
    }
}
