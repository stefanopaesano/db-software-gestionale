<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'nome' => 'chiara',
            'cognome' => 'Rossi',
        ]);

        Cliente::create([
            'nome' => 'Alessia',
            'cognome' => 'ricciardi',
            
        ]);
    }
}
