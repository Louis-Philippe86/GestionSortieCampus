<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('events', function (Blueprint $table) {
$table->id(); // idSortie
$table->string('name');
$table->dateTime('start_date');
$table->integer('duration')->nullable();
$table->dateTime('registration_deadline');
$table->integer('max_participants');
$table->text('info')->nullable();
$table->unsignedBigInteger('state_id'); // état, référence à la table des états
$table->unsignedBigInteger('location_id'); // lieu, référence à la table des lieux
$table->unsignedBigInteger('organizer_id'); // organisateur, référence à la table des participants
$table->timestamps();

// Clés étrangères
$table->foreign('location_id')->references('id')->on('locations');
$table->foreign('organizer_id')->references('id')->on('participants');
$table->foreign('state_id')->references('id')->on('event_states'); // Assurez-vous que cette table est créée
});
}

public function down(): void
{
Schema::dropIfExists('events');
}
};
