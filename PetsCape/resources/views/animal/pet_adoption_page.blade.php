@extends('layouts.index')

@section('title', 'Adopter un Animal')

@section('content')
    <!-- Hero Section Compact -->
    <div class="bg-[#FFF5F5] pt-28 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="space-y-4">
                    <h1 class="text-4xl font-bold text-[#2F2E41]">Trouvez Votre <span class="text-[#FF6B6B]">Compagnon Idéal</span></h1>
                    <p class="text-gray-600">Découvrez nos adorables animaux qui n'attendent que vous</p>
                </div>
                <div class="flex gap-4">
                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-600">Animaux disponibles</p>
                        <p class="text-3xl font-bold text-[#FF6B6B]">{{ $animals->count() }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                        <p class="text-sm text-gray-600">Adoptions réussies</p>
                        <p class="text-3xl font-bold text-[#FF6B6B]">{{ $adoptedCount ?? 0 }}</p>
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
                            <a href="{{ route('animals.adoption') }}" class="px-4 py-2 rounded-full {{ !request('species') ? 'bg-[#FF6B6B] text-white' : 'bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors' }}">Tous</a>
                            @foreach($species as $specie)
                                <a href="{{ route('animals.adoption', ['species' => $specie->id]) }}" class="px-4 py-2 rounded-full {{ request('species') == $specie->id ? 'bg-[#FF6B6B] text-white' : 'bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors' }}">{{ $specie->name }}</a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Âge -->
                    <div class="space-y-3 mb-6">
                        <p class="font-semibold text-[#2F2E41]">Âge</p>
                        <form action="{{ route('animals.adoption') }}" method="GET" id="age-filter-form">
                            @if(request('species'))
                                <input type="hidden" name="species" value="{{ request('species') }}">
                            @endif
                            <input type="range" name="max_age" min="0" max="15" value="{{ request('max_age', 15) }}" class="w-full accent-[#FF6B6B]" id="age-slider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>0 an</span>
                                <span id="age-value">{{ request('max_age', 15) }} ans</span>
                            </div>
                        </form>
                    </div>

                    <!-- Caractéristiques -->
                    <div class="space-y-3">
                        <p class="font-semibold text-[#2F2E41]">Caractéristiques</p>
                        <form action="{{ route('animals.adoption') }}" method="GET" id="characteristic-form">
                            @if(request('species'))
                                <input type="hidden" name="species" value="{{ request('species') }}">
                            @endif
                            @if(request('max_age'))
                                <input type="hidden" name="max_age" value="{{ request('max_age') }}">
                            @endif
                            <div class="space-y-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="kids_friendly" {{ in_array('kids_friendly', request('characteristics', [])) ? 'checked' : '' }} class="w-4 h-4 accent-[#FF6B6B] characteristic-checkbox">
                                    <span class="text-gray-600">Bon avec les enfants</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="calm" {{ in_array('calm', request('characteristics', [])) ? 'checked' : '' }} class="w-4 h-4 accent-[#FF6B6B] characteristic-checkbox">
                                    <span class="text-gray-600">Calme</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="trained" {{ in_array('trained', request('characteristics', [])) ? 'checked' : '' }} class="w-4 h-4 accent-[#FF6B6B] characteristic-checkbox">
                                    <span class="text-gray-600">Dressé</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="characteristics[]" value="social" {{ in_array('social', request('characteristics', [])) ? 'checked' : '' }} class="w-4 h-4 accent-[#FF6B6B] characteristic-checkbox">
                                    <span class="text-gray-600">Sociable</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Liste des animaux -->
            <div class="lg:w-3/4 space-y-6">
                <!-- Barre de recherche et tri -->
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-4 rounded-2xl shadow-sm">
                    <form action="{{ route('animals.adoption') }}" method="GET" class="relative w-full md:w-96" id="search-form">
                        @if(request('species'))
                            <input type="hidden" name="species" value="{{ request('species') }}">
                        @endif
                        @if(request('max_age'))
                            <input type="hidden" name="max_age" value="{{ request('max_age') }}">
                        @endif
                        @if(request('characteristics'))
                            @foreach(request('characteristics') as $char)
                                <input type="hidden" name="characteristics[]" value="{{ $char }}">
                            @endforeach
                        @endif
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un animal..." class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2">🔍</button>
                    </form>
                    <form action="{{ route('animals.adoption') }}" method="GET" id="sort-form">
                        @if(request('species'))
                            <input type="hidden" name="species" value="{{ request('species') }}">
                        @endif
                        @if(request('max_age'))
                            <input type="hidden" name="max_age" value="{{ request('max_age') }}">
                        @endif
                        @if(request('characteristics'))
                            @foreach(request('characteristics') as $char)
                                <input type="hidden" name="characteristics[]" value="{{ $char }}">
                            @endforeach
                        @endif
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="sort" class="px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" id="sort-select">
                            <option value="recent" {{ request('sort') == 'recent' || !request('sort') ? 'selected' : '' }}>Trier par : Plus récent</option>
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
                                <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}" 
                                     alt="{{ $animal->name }}" 
                                     class="w-full h-48 object-cover">
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
                                <a href="{{ route('animals.show', $animal->id) }}" class="block w-full py-3 bg-[#FFE3E3] text-center text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                    Rencontrer {{ $animal->name }}
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-12 text-center">
                            <div class="mb-4 text-5xl">🐾</div>
                            <h3 class="text-2xl font-bold text-[#2F2E41] mb-2">Aucun animal trouvé</h3>
                            <p class="text-gray-600">Essayez de modifier vos filtres de recherche</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($animals->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $animals->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Age filter handling
        const ageSlider = document.getElementById('age-slider');
        const ageValue = document.getElementById('age-value');
        const ageForm = document.getElementById('age-filter-form');

        if (ageSlider) {
            ageSlider.addEventListener('input', (e) => {
                ageValue.textContent = `${e.target.value} ans`;
            });
            
            ageSlider.addEventListener('change', () => {
                ageForm.submit();
            });
        }

        // Characteristic filter handling
        const characteristicCheckboxes = document.querySelectorAll('.characteristic-checkbox');
        const characteristicForm = document.getElementById('characteristic-form');

        characteristicCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                characteristicForm.submit();
            });
        });

        // Sort handling
        const sortSelect = document.getElementById('sort-select');
        const sortForm = document.getElementById('sort-form');

        if (sortSelect) {
            sortSelect.addEventListener('change', () => {
                sortForm.submit();
            });
        }
    });
    </script>
@endsection