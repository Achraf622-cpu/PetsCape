<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetsCape - Adoptez et Prenez Soin de Vos Animaux</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .blob-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="bg-[#FDFAF6]">
<!-- Navigation -->
<nav class="fixed w-full z-50 bg-opacity-90 backdrop-blur-md bg-[#FDFAF6]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center py-6">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-[#FF6B6B] blob-shape"></div>
                <h1 class="text-2xl font-bold text-[#2F2E41]">PetsCape</h1>
            </div>

            <!-- Menu mobile -->
            <div class="block md:hidden">
                <button class="p-2" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Menu desktop -->
            <div class="hidden md:flex items-center gap-12">
                <a href="/" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Accueil</a>
                <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Adopter</a>
                <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Boutique</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline" id="logout-form">
                        @csrf
                        <button type="button" onclick="confirmLogout()" class="px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Se connecter</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Menu mobile panel -->
    <div class="hidden md:hidden absolute top-20 left-0 right-0 bg-white p-4 shadow-lg z-50" id="mobile-menu">
        <div class="flex flex-col gap-4">
            <a href="/" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Accueil</a>
            <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Adopter</a>
            <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Boutique</a>
            @auth
                <a href="{{ route('dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                <form method="POST" action="{{ route('logout') }}" id="mobile-logout-form">
                    @csrf
                    <button type="button"
                            onclick="confirmMobileLogout()"
                            class="w-full text-center px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Se connecter</a>
                <a href="{{ route('register') }}" class="text-center px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</nav>



<!-- Hero Section -->
<div class="pt-32 pb-20 px-6">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-8">
            <div class="inline-block px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">
                🐾 Adoption responsable
            </div>
            <h2 class="text-5xl font-bold text-[#2F2E41] leading-tight">
                Donnez de l'amour, <br>
                <span class="text-[#FF6B6B]">Recevez-en plus</span>
            </h2>
            <p class="text-gray-600 text-lg">
                Découvrez nos adorables compagnons qui n'attendent que vous pour commencer une nouvelle vie remplie d'amour.
            </p>
            <div class="flex gap-4">
                <button class="px-8 py-4 bg-[#FF6B6B] text-white rounded-2xl hover:bg-[#FF8787] transition-transform hover:scale-105">
                    Adopter maintenant
                </button>
                <button class="px-8 py-4 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-2xl hover:bg-[#FFE3E3] transition-colors">
                    Voir nos animaux
                </button>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -top-10 -left-10 w-72 h-72 bg-[#FFE3E3] rounded-full filter blur-3xl opacity-70"></div>
            <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-[#FFD1D1] rounded-full filter blur-3xl opacity-70"></div>
            <img src="path/to/hero-pet.png" alt="Happy pet" class="relative z-10 w-full h-auto rounded-3xl">
        </div>
    </div>
</div>

<!-- Featured Pets Section -->
<div class="py-20 px-6 bg-[#FFF5F5]">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h3 class="text-[#FF6B6B] font-bold mb-2">Nos stars à adopter</h3>
                <h2 class="text-4xl font-bold text-[#2F2E41]">Trouvez votre compagnon</h2>
            </div>
            <button class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tous →</button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="featured-pets"></div>
    </div>
</div>
</body>

<script>
    const pets = [
        {
            name: 'Luna',
            species: 'Chat',
            age: '2 ans',
            personality: 'Joueuse',
            image: 'path/to/cat-image.jpg'
        },
        {
            name: 'Max',
            species: 'Chien',
            age: '3 ans',
            personality: 'Affectueux',
            image: 'path/to/dog-image.jpg'
        },
        {
            name: 'Coco',
            species: 'Perroquet',
            age: '1 an',
            personality: 'Bavard',
            image: 'path/to/parrot-image.jpg'
        }
    ];

    document.addEventListener('DOMContentLoaded', () => {
        const featuredPetsContainer = document.getElementById('featured-pets');

        pets.forEach(pet => {
            const card = `
            <div class="bg-white rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="${pet.image}" alt="${pet.name}" class="w-full h-64 object-cover">
                    <div class="absolute bottom-4 left-4 bg-white px-4 py-2 rounded-full text-sm">
                        ${pet.species}
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-[#2F2E41]">${pet.name}</h3>
                        <span class="text-[#FF6B6B]">${pet.age}</span>
                    </div>
                    <p class="text-gray-600 mb-6">Personnalité: ${pet.personality}</p>
                    <button class="w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors">
                        Rencontrer ${pet.name}
                    </button>
                </div>
            </div>
        `;
            featuredPetsContainer.innerHTML += card;
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    });

    function confirmLogout() {
        if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
            document.getElementById('logout-form').submit();
        }
    }


</script>
</html>
