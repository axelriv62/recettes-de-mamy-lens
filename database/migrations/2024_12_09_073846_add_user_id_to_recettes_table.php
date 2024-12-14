<?php

use App\Models\User;
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
        Schema::table('taches', function (Blueprint $table) {
            $table->foreignIdFor(User::class)
                ->nullable()
                ->default(null)
                ->comment('Identifiant de l\'utilisateur qui a créé la recette')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recettes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
};
