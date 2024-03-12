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
        Schema::table('sorties',function (Blueprint $table){
            $table->foreignIdFor(\App\Models\Etat::class);
            $table->foreignIdFor(\App\Models\Lieu::class);
            $table->foreignIdFor(\App\Models\Campus::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sorties',function (Blueprint $table){
            $table->dropForeign(\App\Models\Etat::class);
            $table->dropForeign(\App\Models\Lieu::class);
            $table->dropForeign(\App\Models\Campus::class);
        });

    }
};
