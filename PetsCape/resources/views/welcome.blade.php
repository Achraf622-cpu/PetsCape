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
                <a href="{{ route('animals.adoption') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Adopter</a>
                <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Boutique</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Dashboard</a>
                        <a href="/direct-admin" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Direct Admin</a>
                        <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline" id="logout-form">
                        @csrf
                        <button type="button" onclick="if(confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) document.getElementById('logout-form').submit();" class="px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
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
            <a href="{{ route('animals.adoption') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Adopter</a>
            <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Boutique</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Dashboard</a>
                    <a href="/direct-admin" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Direct Admin</a>
                    <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                @endif
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
                <button onclick="window.location.href='{{ route('animals.adoption') }}'" class="px-8 py-4 bg-[#FF6B6B] text-white rounded-2xl hover:bg-[#FF8787] transition-transform hover:scale-105">
                    Adopter maintenant
                </button>
                <button onclick="window.location.href='{{ route('animals.adoption') }}'" class="px-8 py-4 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-2xl hover:bg-[#FFE3E3] transition-colors">
                    Voir nos animaux
                </button>
            </div>
        </div>
        <div class="relative">
            <div class="absolute -top-10 -left-10 w-72 h-72 bg-[#FFE3E3] rounded-full filter blur-3xl opacity-70"></div>
            <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-[#FFD1D1] rounded-full filter blur-3xl opacity-70"></div>
            @if(isset($featuredAnimals[0]))
                <img src="{{ $featuredAnimals[0]->image ? asset('storage/'.$featuredAnimals[0]->image) : asset('images/default-animal.jpg') }}"
                     alt="Pet adoption"
                     class="relative z-10 w-full h-[400px] object-cover rounded-3xl">
            @else
                <div class="relative z-10 w-full h-[400px] bg-[#FFE3E3] rounded-3xl flex items-center justify-center">
                    <span class="text-6xl">🐾</span>
                </div>
            @endif
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
            <a href="{{ route('animals.adoption') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tous →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredAnimals as $animal)
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="relative">
                        <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}"
                             alt="{{ $animal->name }}"
                             class="w-full h-64 object-cover">
                        <div class="absolute bottom-4 left-4 bg-white px-4 py-2 rounded-full text-sm">
                            {{ $animal->species->name ?? 'Non défini' }}
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-[#2F2E41]">{{ $animal->name }}</h3>
                            <span class="text-[#FF6B6B]">{{ $animal->age }} an(s)</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                            <span>🐾</span> {{ $animal->breed }}
                        </div>
                        <a href="{{ route('animals.show', $animal) }}"
                           class="block w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors text-center">
                            Rencontrer {{ $animal->name }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-10">
                    <div class="text-5xl mb-4">🐾</div>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">Aucun animal disponible pour le moment</h3>
                    <p class="text-gray-600 mt-2">Revenez bientôt pour découvrir nos nouveaux pensionnaires</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Menu mobile toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        window.confirmMobileLogout = function() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                document.getElementById('mobile-logout-form').submit();
            }
        };

        window.confirmLogout = function() {
            if (confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                document.getElementById('logout-form').submit();
            }
        };
    });
</script>
</html>
