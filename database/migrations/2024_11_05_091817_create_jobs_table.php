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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->foreignId('tecnico_id')  // Usa il nome corretto della colonna
            ->constrained('tecnici')      // Indica che fa riferimento alla tabella 'tecnici'
            ->onDelete('cascade');       
            $table->foreignId('cliente_id')
            ->constrained('clienti')     // Fa riferimento alla tabella 'clients'
            ->onDelete('cascade');
            $table->date('data_lavoro');
            $table->text('descrizione_lavoro');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('jobs');
    // }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
};
