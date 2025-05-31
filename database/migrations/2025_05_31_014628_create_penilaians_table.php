<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
        $table->id();
        $table->foreignId('alternatif_id')->constrained()->onDelete('cascade');
        $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
        $table->tinyInteger('nilai'); // antara 1 - 5
        $table->timestamps();

        $table->unique(['alternatif_id', 'kriteria_id']);
         });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
