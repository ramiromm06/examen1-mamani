<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva [cite: 76, 85]
    protected $fillable = [
        'title',
        'content',
        'is_public',
        'category_id'
    ];

    /**
     * Cast del campo is_public a booleano[cite: 39, 76, 85].
     */
    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Una nota pertenece a una única categoría[cite: 31, 74].
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación muchos a muchos con User a través de note_user[cite: 33, 74].
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role') // Incluye el tipo de acceso (owner, editor, viewer) [cite: 33, 74, 82]
            ->withTimestamps(); // Registra created_at y updated_at en el pivote [cite: 41, 74, 83]
    }
}