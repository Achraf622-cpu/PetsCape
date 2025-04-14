<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assurez-vous que le dossier storage/app/public/animals existe
        if (!Storage::disk('public')->exists('animals')) {
            Storage::disk('public')->makeDirectory('animals');
        }

        $animals = [
            [
                'name' => 'Luna',
                'species_id' => 2, // Chat
                'breed' => 'Européen',
                'age' => 2,
                'description' => 'Luna est une chatte douce et affectueuse qui adore les câlins. Malgré son passé difficile, elle s\'est révélée être extraordinairement sociable. Elle ronronne dès qu\'on s\'approche d\'elle et adore jouer avec des jouets à plumes.',
                'status' => 'available',
                'location' => 'Refuge Paris, Box 3',
                'image' => 'animals/luna.jpg',
            ],
            [
                'name' => 'Max',
                'species_id' => 1, // Chien
                'breed' => 'Berger Allemand',
                'age' => 3,
                'description' => 'Max est un chien énergique et intelligent qui a besoin d\'exercice quotidien. Il est très fidèle et protecteur envers sa famille. Il s\'entend bien avec les enfants et adore les promenades en forêt. Max connaît déjà plusieurs commandes de base.',
                'status' => 'available',
                'location' => 'Refuge Lyon, Enclos 5',
                'image' => 'animals/max.jpg',
            ],
            [
                'name' => 'Coco',
                'species_id' => 4, // Oiseau
                'breed' => 'Perruche',
                'age' => 1,
                'description' => 'Coco est une perruche très colorée et bavarde. Elle adore siffler des mélodies et peut même répéter quelques mots. Elle est très active et aura besoin d\'une cage spacieuse avec de nombreux jouets pour s\'occuper.',
                'status' => 'available',
                'location' => 'Refuge Marseille, Volière 2',
                'image' => 'animals/coco.jpg',
            ],
            [
                'name' => 'Felix',
                'species_id' => 2, // Chat
                'breed' => 'Siamois',
                'age' => 4,
                'description' => 'Felix est un chat siamois avec beaucoup de caractère. Il est très vocal et vous fera savoir quand il a besoin d\'attention. Il préfère être l\'unique animal de la maison et a besoin d\'un environnement calme. Felix est propre et indépendant.',
                'status' => 'available',
                'location' => 'Refuge Lille, Box 7',
                'image' => 'animals/felix.jpg',
            ],
            [
                'name' => 'Rocky',
                'species_id' => 1, // Chien
                'breed' => 'Jack Russell',
                'age' => 2,
                'description' => 'Rocky est un petit chien plein d\'énergie et très joueur. Malgré sa petite taille, il a besoin de beaucoup d\'exercice et d\'activités pour canaliser son énergie. Il est très intelligent et apprend rapidement.',
                'status' => 'available',
                'location' => 'Refuge Bordeaux, Enclos 3',
                'image' => 'animals/rocky.jpg',
            ],
            [
                'name' => 'Caramel',
                'species_id' => 3, // Lapin
                'breed' => 'Nain',
                'age' => 1,
                'description' => 'Caramel est un adorable lapin nain au pelage brun doré. Il est curieux et aime explorer son environnement. Il peut être timide au début mais devient vite affectueux. Il est propre et peut être facilement éduqué à utiliser un bac.',
                'status' => 'available',
                'location' => 'Refuge Toulouse, Enclos petits animaux',
                'image' => 'animals/caramel.jpg',
            ],
            [
                'name' => 'Milo',
                'species_id' => 5, // Rongeur
                'breed' => 'Hamster',
                'age' => 1,
                'description' => 'Milo est un hamster doré très actif la nuit. Il adore courir dans sa roue et creuser des tunnels. C\'est un petit animal facile à vivre qui demande peu d\'entretien, parfait pour initier les enfants aux responsabilités d\'un animal de compagnie.',
                'status' => 'available',
                'location' => 'Refuge Nice, Section rongeurs',
                'image' => 'animals/milo.jpg',
            ],
            [
                'name' => 'Bella',
                'species_id' => 1, // Chien
                'breed' => 'Golden Retriever',
                'age' => 5,
                'description' => 'Bella est une chienne très douce et patiente. Elle adore les enfants et s\'entend bien avec les autres animaux. Elle est déjà bien éduquée et connaît plusieurs commandes. Bella a besoin d\'une famille aimante pour sa retraite.',
                'status' => 'available',
                'location' => 'Refuge Strasbourg, Enclos 8',
                'image' => 'animals/bella.jpg',
            ],
        ];

        foreach ($animals as $animalData) {
            // Créer l'animal sans l'image pour commencer
            $imageFile = $animalData['image'];
            unset($animalData['image']);

            $animal = Animal::create($animalData);

            // Note : dans un environnement réel, vous devriez avoir
            // des images dans un dossier et les copier dans storage.
            // Ici, on simule simplement le chemin de l'image.
            $animal->image = $imageFile;
            $animal->save();
        }
    }
}
