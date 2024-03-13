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
        Schema::create('campus', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
        });
        Schema::create('sorties', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->dateTime('dateHeureDebut');
            $table->integer('duree');
            $table->date('dateLimiteInscription');
            $table->integer('nbInscriptionMax');
            $table->text('infosSortie');
            $table->string('etat');
        });
        Schema::create('lieux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('rue');
            $table->float('latitude');
            $table->float('longitude');
        });
        Schema::create('villes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('codePostal');

        });
        Schema::create('etats', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');

        });
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('adminitrateur')->default(false);
            $table->boolean('actif')->default(false);
            $table->string('remember_me');
            $table->string('password_not_crypted');

        });
        Schema::create('organisateurs', function (Blueprint $table) {
            $table->id();
            $table->integer('idParticipant');
            $table->integer('idSortie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campus');
        Schema::dropIfExists('sorties');
        Schema::dropIfExists('lieux');
        Schema::dropIfExists('villes');
        Schema::dropIfExists('etats');
        Schema::dropIfExists('participants');
        Schema::dropIfExists('organisateurs');
    }
};
