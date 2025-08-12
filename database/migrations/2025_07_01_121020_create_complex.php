<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //quando creo la tabella del complesso
    public function up(): void
    {
        Schema::create('complexes', function (Blueprint $table) {
            $table->id(); //ID univoco per il complesso
            $table->string('name'); // nome del complesso sportivo
            $table->string('address'); // indirizzo fisico del complesso
            $table->string('city'); // città del complesso
            $table->string('postal_code'); // codice postale del complesso
            $table->string('phone');
            $table->json('opening_hours'); // orari di apertura del complesso, gestiti come JSON
            $table->string('email')->nullable();
            $table->text('description')->nullable(); // descrizione del complesso
            $table->timestamps(); // timestamps per created_at e updated_at
        });
    }

    //quando elimino la tabella
    public function down(): void
    {
        Schema::dropIfExists('complexes');
    }
};
