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
        Schema::table('participants',function (Blueprint $table){
            $table->foreignIdFor(\App\Models\Campus::class);
            $table->foreignIdFor(\App\Models\Sortie::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants',function (Blueprint $table){
            $table->dropForeignIdFor(\App\Models\Campus::class);
            $table->dropForeignIdFor(\App\Models\Sortie::class);
        });
    }
};
