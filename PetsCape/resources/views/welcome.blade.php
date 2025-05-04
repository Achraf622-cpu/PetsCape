<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        .pet-card {
            transition: all 0.3s ease;
        }
        .pet-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        [data-scroll-reveal] {
            opacity: 0;
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        [data-scroll-reveal].revealed {
            opacity: 1;
        }
    </style>

    <script src="{{ asset('js/app.js') }}" defer></script>
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
    <div class="hidden md:hidden absolute top-20 left-0 right-0 bg-white p-4 shadow-lg z-50" id="mobile-menu" style="opacity: 1; transform: none;">
        <div class="flex flex-col gap-4">
            <a href="/" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Accueil</a>
            <a href="{{ route('animals.adoption') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Adopter</a>
            <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Boutique</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Dashboard</a>
                    <a href="/direct-admin" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Direct Admin</a>
                    <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Mon Profil</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Mon Profil</a>
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
                <a href="{{ route('login') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors block py-2">Se connecter</a>
                <a href="{{ route('register') }}" class="text-center px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
                    S'inscrire
                </a>
            @endauth
        </div>
    </div>
</nav>



<!-- Hero Section -->
<div class="pt-32 pb-20 px-6 hero-section">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
        <div class="space-y-8" data-scroll-reveal data-scroll-direction="left">
            <div class="inline-block px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">
                🐾 Adoption responsable
            </div>
            <h2 class="text-5xl font-bold text-[#2F2E41] leading-tight hero-title">
                Donnez de l'amour, <br>
                <span class="text-[#FF6B6B]">Recevez-en plus</span>
            </h2>
            <p class="text-gray-600 text-lg">
                Découvrez nos adorables compagnons qui n'attendent que vous pour commencer une nouvelle vie remplie d'amour.
            </p>
            <div class="flex gap-4">
                <button onclick="window.location.href='{{ route('animals.adoption') }}'" class="hero-button px-8 py-4 bg-[#FF6B6B] text-white rounded-2xl hover:bg-[#FF8787] transition-transform hover:scale-105">
                    Adopter maintenant
                </button>
                <button onclick="window.location.href='{{ route('animals.adoption') }}'" class="hero-button px-8 py-4 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-2xl hover:bg-[#FFE3E3] transition-colors">
                    Voir nos animaux
                </button>
            </div>
        </div>
        <div class="relative" data-scroll-reveal data-scroll-direction="right">
            <div class="absolute -top-10 -left-10 w-72 h-72 bg-[#FFE3E3] rounded-full filter blur-3xl opacity-70" data-parallax data-parallax-speed="0.1"></div>
            <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-[#FFD1D1] rounded-full filter blur-3xl opacity-70" data-parallax data-parallax-speed="0.15"></div>
            @if(isset($featuredAnimals[0]))
                <img src="{{ $featuredAnimals[0]->image ? asset('storage/'.$featuredAnimals[0]->image) : asset('images/default-animal.jpg') }}"
                     alt="Pet adoption"
                     class="relative z-10 w-full h-[400px] object-cover rounded-3xl hero-image">
            @else
                <div class="relative z-10 w-full h-[400px] bg-[#FFE3E3] rounded-3xl flex items-center justify-center hero-image">
                    <span class="text-6xl">🐾</span>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Featured Pets Section -->
<div class="py-20 px-6 bg-[#FFF5F5]">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-12" data-scroll-reveal>
            <div>
                <h3 class="text-[#FF6B6B] font-bold mb-2">Nos stars à adopter</h3>
                <h2 class="text-4xl font-bold text-[#2F2E41]">Trouvez votre compagnon</h2>
            </div>
            <a href="{{ route('animals.adoption') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tous →</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($featuredAnimals as $index => $animal)
                <div class="bg-white rounded-3xl overflow-hidden hover:shadow-xl transition-all duration-300 pet-card" 
                     data-scroll-reveal 
                     data-scroll-delay="{{ $index * 150 }}">
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
                <div class="col-span-3 text-center py-10" data-scroll-reveal>
                    <div class="text-5xl mb-4">🐾</div>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">Aucun animal disponible pour le moment</h3>
                    <p class="text-gray-600 mt-2">Revenez bientôt pour découvrir nos nouveaux pensionnaires</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Inline JavaScript for essential functions -->
<script>
    // Mobile menu toggle - fixed version
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            // Don't close the menu automatically when clicking inside it
            mobileMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
            
            // Toggle menu when clicking the button
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });
            
            // Close menu when clicking outside
            document.addEventListener('click', function() {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
            
            // Close menu when clicking a link (after navigation)
            const menuLinks = mobileMenu.querySelectorAll('a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    setTimeout(function() {
                        mobileMenu.classList.add('hidden');
                    }, 100);
                });
            });
        }

        // Basic confirmation for logout
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
        
        // Simple scroll animations
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('[data-scroll-reveal]');
            
            elements.forEach(el => {
                const rect = el.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                
                if (rect.top <= windowHeight * 0.85) {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                    el.classList.add('revealed');
                }
            });
        };
        
        // Set initial state for scroll reveal elements
        document.querySelectorAll('[data-scroll-reveal]').forEach(el => {
            const direction = el.dataset.scrollDirection || 'up';
            
            if (direction === 'left') {
                el.style.transform = 'translateX(-30px)';
            } else if (direction === 'right') {
                el.style.transform = 'translateX(30px)';
            } else {
                el.style.transform = 'translateY(30px)';
            }
        });
        
        // Run on page load and scroll
        animateOnScroll();
        window.addEventListener('scroll', animateOnScroll);
        
        // Simple parallax effect
        window.addEventListener('scroll', () => {
            const parallaxElements = document.querySelectorAll('[data-parallax]');
            const scrollY = window.pageYOffset;
            
            parallaxElements.forEach(el => {
                const speed = parseFloat(el.dataset.parallaxSpeed || 0.2);
                el.style.transform = `translateY(${scrollY * speed}px)`;
            });
        });
    });
</script>
</body>
</html>
