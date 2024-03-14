<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id('idparticipant');
            $table->string('name'); // nom
            $table->string('surname'); // prénom
            $table->string('phone')->nullable(); // telephone
            $table->string('email')->unique(); // mail
            $table->string('password'); // motPasse
            $table->boolean('administrator')->default(false); // administrateur
            $table->boolean('active')->default(true); // actif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
