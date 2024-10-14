<?php

use App\Models\Etablissement;
use App\Models\EtablissementFiliere;
use App\Models\Niveau;
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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('nomclasse');
            $table->foreignIdFor(EtablissementFiliere::class);
            $table->foreignIdFor(Niveau::class);
            $table->foreignIdFor(Etablissement::class)->onDelete('cascade');
            $table->string('nbclasse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
