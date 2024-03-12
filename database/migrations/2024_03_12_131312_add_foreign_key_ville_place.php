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
        Schema::table('lieux',function (Blueprint $table){
            $table->foreignIdFor(\App\Models\Ville::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lieux',function (Blueprint $table){
            $table->dropForeignIdFor(\App\Models\Ville::class);
        });
    }
};
