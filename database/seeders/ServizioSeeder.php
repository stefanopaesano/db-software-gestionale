<?php

namespace Database\Seeders;

use App\Models\Servizi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServizioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servizi::create([
            'nome' => 'website',
            'prezzo' => '200',
        ]);

        Servizi::create([
            'nome' => 'mediamanagment',
            'prezzo' => '300',
            
        ]);
    }
}
