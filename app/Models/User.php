<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
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

    /**
     * Relación muchos a muchos con Note a través de note_user[cite: 75].
     */
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class)
            ->withPivot('role') // Incluye la columna pivote role [cite: 74, 79]
            ->withTimestamps(); // Incluye los timestamps del pivote [cite: 74, 79]
    }
}