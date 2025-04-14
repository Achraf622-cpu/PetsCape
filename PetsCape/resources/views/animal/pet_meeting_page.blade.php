@endsection@extends('layouts.index')

@section('title', 'Rencontrer ' . $animal->name)

@section('content')
    <!-- Colonne droite -->
    <div class="lg:w-1/3 space-y-8">
        <!-- Carte d'action -->
        <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-24">
            <div class="text-center space-y-4 mb-6">
                <h2 class="text-2xl font-bold text-[#2F2E41]">Rencontrer {{ $animal->name }}</h2>
                <p class="text-gray-600">Remplissez le formulaire ci-dessous pour organiser une rencontre</p>
            </div>

            <form class="space-y-6" action="{{ route('appointments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="animal_id" value="{{ $animal->id }}">

                <div class="space-y-2">
                    <label class="block text-[#2F2E41] font-semibold">Date souhaitée</label>
                    <input type="date" name="date" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                </div>

                <div class="space-y-2">
                    <label class="block text-[#2F2E41] font-semibold">Créneau horaire</label>
                    <select name="time_slot" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                        <option value="">Sélectionnez un créneau</option>
                        <option value="10:00 - 11:00">10:00 - 11:00</option>
                        <option value="11:00 - 12:00">11:00 - 12:00</option>
                        <option value="14:00 - 15:00">14:00 - 15:00</option>
                        <option value="15:00 - 16:00">15:00 - 16:00</option>
                        <option value="16:00 - 17:00">16:00 - 17:00</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-[#2F2E41] font-semibold">Message (optionnel)</label>
                    <textarea
                        name="message"
                        rows="4"
                        class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        placeholder="Parlez-nous un peu de vous et de votre motivation..."
                    ></textarea>
                </div>

                @guest
                    <div class="p-4 bg-[#FFF5F5] rounded-xl text-center">
                        <p class="text-gray-600 mb-2">Vous devez être connecté pour demander une rencontre</p>
                        <a href="{{ route('login') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">Se connecter</a>
                        <span class="text-gray-600 mx-2">ou</span>
                        <a href="{{ route('register') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">S'inscrire</a>
                    </div>
                @else
                    <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                        Demander une rencontre
                    </button>
                @endguest
            </form>

            <div class="mt-6 p-4 bg-[#FFF5F5] rounded-xl">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                        📍
                    </div>
                    <div>
                        <p class="font-semibold text-[#2F2E41]">Refuge PetsCape</p>
                        <p class="text-sm text-gray-600">{{ $animal->location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div> Navigation (à intégrer à votre layout) -->
    <nav class="fixed w-full z-50 bg-opacity-90 backdrop-blur-md bg-[#FDFAF6]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-[#FF6B6B] blob-shape"></div>
                    <h1 class="text-2xl font-bold text-[#2F2E41]">PetsCape</h1>
                </div>

                <!-- Menu desktop -->
                <div class="hidden md:flex items-center gap-12">
                    <a href="/" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Accueil</a>
                    <a href="{{ route('animals.adoption') }}" class="text-[#FF6B6B]">Adopter</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B] transition-colors">Mon Profil</a>
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
    </nav>

    <main class="pt-24 pb-12">
        <!-- En-tête avec retour -->
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <a href="{{ route('animals.adoption') }}" class="inline-flex items-center gap-2 text-[#FF6B6B] hover:text-[#FF8787] mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Retour aux animaux
            </a>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Colonne gauche -->
                <div class="lg:w-2/3 space-y-8">
                    <!-- Galerie photos -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}"
                             alt="{{ $animal->name }}"
                             class="w-full h-[500px] object-cover">
                    </div>

                    <!-- Informations détaillées -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <h1 class="text-3xl font-bold text-[#2F2E41] mb-6">À propos de {{ $animal->name }}</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Âge</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Espèce</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->species->name }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Race</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->breed }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Localisation</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->location }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Description</h2>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $animal->description }}
                                </p>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Personnalité</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->species->name }}</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->breed }}</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

