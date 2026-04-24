<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('note_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')
                ->constrained('notes')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('role', 20); // owner, editor, viewer
            $table->timestamps();

            // Restricción única para evitar roles duplicados por usuario/nota [cite: 51, 65]
            $table->unique(['note_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note_user');
    }
};
