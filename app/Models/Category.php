<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva [cite: 76]
    protected $fillable = ['name', 'description'];

    /**
     * Una categoría tiene muchas notas (1:N)[cite: 31, 73].
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}