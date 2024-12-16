<?php
namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    
    public function run(): void
    {
        
        Job::create([
            'title' => 'Software Developer',
            'description' => 'We are looking for a skilled software developer...',
            'location' => 'Remote',
            'tecnico_id' => 1, 
            'cliente_id' => 1, 
            'data_lavoro' => '2024-11-15', 
            'descrizione_lavoro' => 'Develop software solutions for the client.', 
        ]);

        Job::create([
            'title' => 'Product Manager',
            'description' => 'A product manager responsible for overseeing...',
            'location' => 'New York',
            'tecnico_id' => 2, 
            'cliente_id' => 2, 
            'data_lavoro' => '2024-11-16', 
            'descrizione_lavoro' => 'Manage the product development lifecycle.', 
        ]);
    }
}
