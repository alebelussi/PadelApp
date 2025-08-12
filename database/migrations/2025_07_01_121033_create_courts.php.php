<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //quando creo la tabella per i campi da prenotare
    public function up(): void
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->id(); //id autoincrementale della prenotazione che funge come chiave primaria
            $table->string('name');
            $table->enum('status', ['active', 'maintenance', 'inactive'])->default('active'); //stato del campo, attivo, in manutenzione o inattivo
            $table->enum('type', ['indoor', 'outdoor'])->default('outdoor'); //tipo di campo, indoor o outdoor
            $table->string('description')->nullable(); 
            $table->string('location'); 
            $table->decimal('price_per_hour', 8, 2); 
            $table->boolean('is_available')->default(true); //disponibilità del campo
            $table->string('image_path')->nullable();
            $table->timestamps(); //timestamp per la creazione e l'aggiornamento

            //chiavi esterne
            $table->foreignId('complex_id')->constrained()->onDelete('cascade'); //chiave esterna all'id del complesso a cui appartiene il campo
        });
    }

    //quando elimino la tabella
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
