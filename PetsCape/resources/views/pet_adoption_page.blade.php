<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adopter un Animal - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css"/>
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .custom-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="bg-[#FDFAF6]">
    <!-- Navigation (comme précédemment) -->
    
    <!-- Hero Section Compact -->
    <div class="bg-[#FFF5F5] pt-24 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1 class="text-4xl font-bold text-[#2F2E41]">Trouvez Votre <span class="text-[#FF6B6B]">Compagnon Idéal</span></h1>
                    <p class="text-gray-600">Découvrez nos adorables animaux qui n'attendent que vous</p>
                </div>
                <div class="flex gap-4">
                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-600">Animaux disponibles</p>
                        <p class="text-3xl font-bold text-[#FF6B6B]">42</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-600">Adoptions réussies</p>
                        <p class="text-3xl font-bold text-[#FF6B6B]">1,238</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et Contenu Principal -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filtres (Sidebar) -->
            <div class="lg:w-1/4 space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-[#2F2E41] mb-4">Filtres</h3>
                    
                    <!-- Type d'animal -->
                    <div class="space-y-3 mb-6">
                        <p class="font-semibold text-[#2F2E41]">Type d'animal</p>
                        <div class="flex flex-wrap gap-2">
                            <button class="px-4 py-2 rounded-full bg-[#FF6B6B] text-white" data-type="all">Tous</button>
                            <button class="px-4 py-2 rounded-full bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors" data-type="chiens">Chiens</button>
                            <button class="px-4 py-2 rounded-full bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors" data-type="chats">Chats</button>
                            <button class="px-4 py-2 rounded-full bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors" data-type="autres">Autres</button>
                        </div>
                    </div>

                    <!-- Âge -->
                    <div class="space-y-3 mb-6">
                        <p class="font-semibold text-[#2F2E41]">Âge</p>
                        <input type="range" min="0" max="15" value="15" class="w-full accent-[#FF6B6B]">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>0 an</span>
                            <span id="age-value">15 ans</span>
                        </div>
                    </div>

                    <!-- Caractéristiques -->
                    <div class="space-y-3">
                        <p class="font-semibold text-[#2F2E41]">Caractéristiques</p>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="w-4 h-4 accent-[#FF6B6B]">
                                <span class="text-gray-600">Bon avec les enfants</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="w-4 h-4 accent-[#FF6B6B]">
                                <span class="text-gray-600">Calme</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="w-4 h-4 accent-[#FF6B6B]">
                                <span class="text-gray-600">Dressé</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="w-4 h-4 accent-[#FF6B6B]">
                                <span class="text-gray-600">Sociable</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des animaux -->
            <div class="lg:w-3/4 space-y-6">
                <!-- Barre de recherche et tri -->
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl shadow-sm">
                    <div class="relative w-full md:w-96">
                        <input type="text" placeholder="Rechercher un animal..." class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <button class="absolute right-3 top-1/2 -translate-y-1/2">🔍</button>
                    </div>
                    <select class="px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <option>Trier par : Plus récent</option>
                        <option>Trier par : Plus ancien</option>
                        <option>Trier par : Âge croissant</option>
                        <option>Trier par : Âge décroissant</option>
                    </select>
                </div>

                <!-- Grille des animaux -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="pets-grid">
                    <!-- Les cartes d'animaux seront générées ici via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
    // Données exemple
    const pets = [
        {
            id: 1,
            name: "Luna",
            type: "chats",
            age: 2,
            image: "path/to/cat1.jpg",
            characteristics: ["Calme", "Sociable"],
            description: "Luna est une chatte douce et affectueuse qui adore les câlins.",
            location: "Paris",
            arrivalDate: "2024-01-15"
        },
        // Ajoutez plus d'animaux ici
    ];

    // Génération des cartes d'animaux
    function generatePetCards(petsData) {
        const grid = document.getElementById('pets-grid');
        grid.innerHTML = petsData.map(pet => `
            <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                <div class="relative">
                    <img src="${pet.image}" alt="${pet.name}" class="w-full h-48 object-cover">
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm">
                        ${pet.age} an${pet.age > 1 ? 's' : ''}
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-xl font-bold text-[#2F2E41]">${pet.name}</h3>
                        <span class="text-sm text-gray-600">${pet.location}</span>
                    </div>
                    <p class="text-gray-600 mb-4 line-clamp-2">${pet.description}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        ${pet.characteristics.map(char => 
                            `<span class="px-3 py-1 bg-[#FFE3E3] text-[#FF6B6B] rounded-full text-sm">${char}</span>`
                        ).join('')}
                    </div>
                    <button class="w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors">
                        Rencontrer ${pet.name}
                    </button>
                </div>
            </div>
        `).join('');
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        generatePetCards(pets);

        // Gestion des filtres
        const typeButtons = document.querySelectorAll('[data-type]');
        typeButtons.forEach(button => {
            button.addEventListener('click', () => {
                typeButtons.forEach(btn => btn.classList.remove('bg-[#FF6B6B]', 'text-white'));
                button.classList.add('bg-[#FF6B6B]', 'text-white');
                // Ajoutez ici la logique de filtrage
            });
        });

        // Gestion du slider d'âge
        const ageSlider = document.querySelector('input[type="range"]');
        const ageValue = document.getElementById('age-value');
        ageSlider.addEventListener('input', (e) => {
            ageValue.textContent = `${e.target.value} ans`;
            // Ajoutez ici la logique de filtrage par âge
        });
    });
    </script>
</body>
</html>