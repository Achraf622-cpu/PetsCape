<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un utilisateur administrateur
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'PetsCape',
            'email' => 'admin@petscape.fr',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Création d'un utilisateur standard
        User::create([
            'firstname' => 'Jean',
            'lastname' => 'Dupont',
            'email' => 'user@petscape.fr',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Appel des autres seeders
        $this->call([
            SpeciesSeeder::class,
            AnimalSeeder::class,
        ]);
    }
}
