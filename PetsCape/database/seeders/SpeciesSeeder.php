<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            [
                'name' => 'Chien',
                'description' => 'Meilleur ami de l\'homme, fidèle et affectueux.',
            ],
            [
                'name' => 'Chat',
                'description' => 'Félin domestique, indépendant et joueur.',
            ],
            [
                'name' => 'Lapin',
                'description' => 'Petit animal doux et sociable.',
            ],
            [
                'name' => 'Oiseau',
                'description' => 'Animal à plumes souvent coloré et mélodieux.',
            ],
            [
                'name' => 'Rongeur',
                'description' => 'Petits mammifères comme les hamsters, souris et cochons d\'Inde.',
            ],
        ];

        foreach ($species as $specie) {
            Species::create($specie);
        }
    }
}
