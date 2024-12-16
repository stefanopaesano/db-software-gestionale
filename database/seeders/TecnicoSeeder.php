<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tecnico;

class TecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tecnico::create([
            'nome' => 'Mario',
            'cognome' => 'Rossi',
        ]);

        Tecnico::create([
            'nome' => 'Alessio',
            'cognome' => 'Allegrinii',
            
        ]);
    }
}
