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
        Schema::table('jobs', function (Blueprint $table) {
            $table->time('data_inizio')->nullable();
            $table->time('data_fine')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    
};
