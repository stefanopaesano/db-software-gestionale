<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=> 'riccardo',
            'email' => 'riccardo@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Napoli1998'),
            'lavoro'=> 'Amministratore delegato',
            'img_url' => 'https://static.vecteezy.com/system/resources/previews/021/079/672/original/user-account-icon-for-your-design-only-free-png.png',
        ]);

        
    }
}
