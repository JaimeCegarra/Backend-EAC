<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function userRoles(): HasMany
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles')
                    ->withPivot('ecosistema_laboral_id')
                    ->withTimestamps();
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class, 'estudiante_id');
    }

    public function ecosistemasMatriculado(): BelongsToMany
    {
        return $this->belongsToMany(
            EcosistemaLaboral::class,
            'matriculas',
            'estudiante_id'
        )->withTimestamps();
    }

    public function perfilesHabilitacion(): HasMany
    {
        return $this->hasMany(PerfilHabilitacion::class, 'estudiante_id');
    }

    public function perfilEn(EcosistemaLaboral $ecosistema): ?PerfilHabilitacion
    {
        return $this->perfilesHabilitacion()
                    ->where('ecosistema_laboral_id', $ecosistema->id)
                    ->first();
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
}

class UserRole extends Pivot
{
    protected $table = 'user_roles';

    public function ecosistemaLaboral()
    {
        return $this->belongsTo(EcosistemaLaboral::class, 'ecosistema_laboral_id');
    }
}
