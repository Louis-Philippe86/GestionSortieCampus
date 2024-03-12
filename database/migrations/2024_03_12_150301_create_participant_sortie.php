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
        Schema::create('participant_sortie', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Participant::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Sortie::class)->constrained()->cascadeOnDelete();
            $table->primary(['participant_id','sortie_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participant_sortie');
    }
};
