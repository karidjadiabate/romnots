<?php

use App\Models\Etablissement;
use App\Models\Matiere;
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
        Schema::create('etablissement_matiere', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignIdFor(Etablissement::class)->onDelete('cascade')->nullable();
            $table->foreignIdFor(Matiere::class);
            $table->string('coefficient')->nullable();
            $table->string('credit')->nullable();
            $table->string('volumehoraire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissement_matiere');
    }
};
