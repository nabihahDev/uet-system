<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'signature_path',
        'approval_pin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'approval_pin',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'approval_pin' => 'hashed',
        ];
    }

    public function getRoleAttribute(): string
    {
        if (str_ends_with($this->email, '@bah.ngam')) {
            return 'oc';
        }

        return 'applicant';
    }

    public function isOc(): bool
    {
        return $this->role === 'oc';
    }

    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }
}