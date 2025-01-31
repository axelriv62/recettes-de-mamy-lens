<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->datetime('expiration')->nullable(false);
            $table->string('categorie')->default('A Faire')->nullable(false);
            $table->boolean('effectuee')->default(false);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('taches');
    }
};
