<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's role dynamically based on their email domain.
     */
    public function getRoleAttribute(): string
    {
        if (str_ends_with($this->email, '@bah.ngam')) {
            return 'oc';
        }

        if (str_ends_with($this->email, '@bah.okay')) {
            return 'applicant';
        }

        return 'applicant';
    }

    /**
     * Check if the user is an OC.
     */
    public function isOc(): bool
    {
        return $this->role === 'oc';
    }

    /**
     * Check if the user is an applicant.
     */
    public function isApplicant(): bool
    {
        return $this->role === 'applicant';
    }
}