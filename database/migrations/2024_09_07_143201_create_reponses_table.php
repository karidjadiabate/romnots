<?php

use App\Models\Question;
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
        Schema::create('reponses', function (Blueprint $table) {
            $table->id();
            $table->string('libreponse');
            $table->enum('result', ['bonne_reponse', 'mauvaise_reponse', 'mauvaise_reponse-']);
            $table->integer('points')->default(0);
            $table->boolean('is_correct')->default(false);
            $table->foreignIdFor(Question::class)->onDelete('cascade');
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponses');
    }
};
