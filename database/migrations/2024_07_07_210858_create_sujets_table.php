<?php

use App\Models\Classe;
use App\Models\Etablissement;
use App\Models\EtablissementFiliere;
use App\Models\EtablissementMatiere;
use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\TypeSujet;
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
        Schema::create('sujets', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->foreignIdFor(TypeSujet::class);
            $table->foreignIdFor(EtablissementFiliere::class);
            $table->foreignIdFor(EtablissementMatiere::class);
            $table->foreignIdFor(Classe::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Etablissement::class);
            $table->integer('noteprincipale');
            $table->string('consigne')->nullable();
            $table->time('heure');
            $table->enum('status', ['corrige', 'non-corrige']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sujets');
    }
};
