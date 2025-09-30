<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'document_number',
        'phone',
        'address',
        'city',
        'birth_date',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'birth_date' => 'date',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }

    public function reviewsWritten()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewed_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('Admin');
    }

    public function isMember(): bool
    {
        return $this->hasRole('Miembro');
    }

    public function isTrainer(): bool
    {
        return $this->hasRole('Entrenador');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    /**
     * Calcular la edad del usuario a partir de su fecha de nacimiento
     */
    public function age()
    {
        if (!$this->birth_date) {
            return null;
        }
        return now()->diffInYears($this->birth_date);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function preferences()
    {
        return $this->hasOne(UserPreference::class);
    }
}
