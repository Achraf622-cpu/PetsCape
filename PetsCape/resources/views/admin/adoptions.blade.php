@extends('layouts.index')

@section('title', 'Adopter un Animal')

@section('content')
    <!-- Navigation (à intégrer à votre layout) -->
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
                        <p class="text-3xl font-bold text-[#FF6B6B]">{{ $animals->total() }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-600">Adoptions réussies</p>
                        <p class="text-3xl font-bold text-[#FF6B6B]">{{ App\Models\Animal::where('status', 'adopted')->count() }}</p>
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

                    <form action="{{ route('animals.adoption') }}" method="GET" id="filter-form">
                        <!-- Type d'animal -->
                        <div class="space-y-3 mb-6">
                            <p class="font-semibold text-[#2F2E41]">Type d'animal</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="px-4 py-2 rounded-full {{ !request('species') ? 'bg-[#FF6B6B] text-white' : 'bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white' }} transition-colors filter-species" data-species="">Tous</button>

                                @foreach($species as $specie)
                                    <button type="button" class="px-4 py-2 rounded-full {{ request('species') == $specie->id ? 'bg-[#FF6B6B] text-white' : 'bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white' }} transition-colors filter-species" data-species="{{ $specie->id }}">{{ $specie->name }}</button>
                                @endforeach
                            </div>
                            <input type="hidden" name="species" id="species-input" value="{{ request('species') }}">
                        </div>

                        <!-- Âge -->
                        <div class="space-y-3 mb-6">
                            <p class="font-semibold text-[#2F2E41]">Âge</p>
                            <input type="range" name="age" min="0" max="15" value="{{ request('age', 15) }}" class="w-full accent-[#FF6B6B]" id="age-slider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>0 an</span>
                                <span id="age-value">{{ request('age', 15) }} ans</span>
                            </div>
                        </div>

                        <!-- Caractéristiques -->
                        <div class="space-y-3 mb-6">
                            <p class="font-semibold text-[#2F2E41]">Caractéristiques</p>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="children_friendly" class="w-4 h-4 accent-[#FF6B6B]" {{ in_array('children_friendly', request('characteristics', [])) ? 'checked' : '' }}>
                                    <span class="text-gray-600">Bon avec les enfants</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="calm" class="w-4 h-4 accent-[#FF6B6B]" {{ in_array('calm', request('characteristics', [])) ? 'checked' : '' }}>
                                    <span class="text-gray-600">Calme</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="trained" class="w-4 h-4 accent-[#FF6B6B]" {{ in_array('trained', request('characteristics', [])) ? 'checked' : '' }}>
                                    <span class="text-gray-600">Dressé</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="sociable" class="w-4 h-4 accent-[#FF6B6B]" {{ in_array('sociable', request('characteristics', [])) ? 'checked' : '' }}>
                                    <span class="text-gray-600">Sociable</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                            Appliquer les filtres
                        </button>
                    </form>
                </div>
            </div>

            <!-- Liste des animaux -->
            <div class="lg:w-3/4 space-y-6">
                <!-- Barre de recherche et tri -->
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl shadow-sm">
                    <form action="{{ route('animals.adoption') }}" method="GET" class="relative w-full md:w-96" id="search-form">
                        <input type="hidden" name="species" value="{{ request('species') }}">
                        <input type="hidden" name="age" value="{{ request('age') }}">
                        @foreach(request('characteristics', []) as $char)
                            <input type="hidden" name="characteristics[]" value="{{ $char }}">
                        @endforeach

                        <input type="text" name="search" placeholder="Rechercher un animal..." value="{{ request('search') }}" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">🔍</button>
                    </form>

                    <form action="{{ route('animals.adoption') }}" method="GET" id="sort-form">
                        <input type="hidden" name="species" value="{{ request('species') }}">
                        <input type="hidden" name="age" value="{{ request('age') }}">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @foreach(request('characteristics', []) as $char)
                            <input type="hidden" name="characteristics[]" value="{{ $char }}">
                        @endforeach

                        <select name="sort" class="px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" onchange="document.getElementById('sort-form').submit()">
                            <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Trier par : Plus récent</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Trier par : Plus ancien</option>
                            <option value="age_asc" {{ request('sort') == 'age_asc' ? 'selected' : '' }}>Trier par : Âge croissant</option>
                            <option value="age_desc" {{ request('sort') == 'age_desc' ? 'selected' : '' }}>Trier par : Âge décroissant</option>
                        </select>
                    </form>
                </div>

                <!-- Grille des animaux -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($animals as $animal)
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300">
                            <div class="relative">
                                <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                                <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-full text-sm">
                                    {{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-xl font-bold text-[#2F2E41]">{{ $animal->name }}</h3>
                                    <span class="text-sm text-gray-600">{{ $animal->location }}</span>
                                </div>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $animal->description }}</p>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="px-3 py-1 bg-[#FFE3E3] text-[#FF6B6B] rounded-full text-sm">{{ $animal->species->name }}</span>
                                    <span class="px-3 py-1 bg-[#FFE3E3] text-[#FF6B6B] rounded-full text-sm">{{ $animal->breed }}</span>
                                </div>
                                <a href="{{ route('animals.meeting', $animal) }}" class="block w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] text-center rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                    Rencontrer {{ $animal->name }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-6xl mb-4">🐾</div>
                            <h3 class="text-2xl font-bold text-[#2F2E41]">Aucun animal trouvé</h3>
                            <p class="text-gray-600 mt-2">Essayez de modifier vos critères de recherche</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $animals->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Gestion des filtres par espèce
            const speciesButtons = document.querySelectorAll('.filter-species');
            const speciesInput = document.getElementById('species-input');

            speciesButtons.forEach(button => {
                button.addEventListener('click', () => {
                    speciesButtons.forEach(btn => {
                        btn.classList.remove('bg-[#FF6B6B]', 'text-white');
                        btn.classList.add('bg-[#FFE3E3]', 'text-[#FF6B6B]');
                    });

                    button.classList.remove('bg-[#FFE3E3]', 'text-[#FF6B6B]');
                    button.classList.add('bg-[#FF6B6B]', 'text-white');

                    speciesInput.value = button.dataset.species;
                    document.getElementById('filter-form').submit();
                });
            });

            // Gestion du slider d'âge
            const ageSlider = document.getElementById('age-slider');
            const ageValue = document.getElementById('age-value');

            ageSlider.addEventListener('input', (e) => {
                ageValue.textContent = `${e.target.value} ans`;
            });
        });
    </script>
@endsection
