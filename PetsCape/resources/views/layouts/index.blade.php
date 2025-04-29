<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .blob-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
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
                    @auth
                        <a href="{{ route('donation.form') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Faire un don</a>
                        {{-- Profile link based on user role --}}
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Admin Dashboard</a>
                            <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-6 py-2 bg-[#FF6B6B] text-white rounded-full hover:bg-[#FF8787] transition-colors">
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
                @auth
                    <a href="{{ route('donation.form') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Faire un don</a>
                    {{-- Profile link based on user role --}}
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Admin Dashboard</a>
                        <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" id="mobile-logout-form">
                        @csrf
                        <button type="button"
                                onclick="if(confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) document.getElementById('mobile-logout-form').submit();"
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

    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Menu mobile toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                console.log('Mobile menu elements found');
                mobileMenuButton.addEventListener('click', () => {
                    console.log('Mobile menu button clicked');
                    mobileMenu.classList.toggle('hidden');
                });
            } else {
                console.log('Mobile menu elements not found', { mobileMenuButton, mobileMenu });
            }
        });
    </script>
</body>
</html>