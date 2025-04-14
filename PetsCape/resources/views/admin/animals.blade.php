@extends('admin.layouts.master')

@section('title', 'Gestion des Animaux')
@section('page-title', 'Gestion des Animaux')
@section('page-subtitle', 'Gérez les animaux du refuge')

@section('content')
    <!-- Actions principales -->
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('animals.create') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2">
            <span>➕</span> Ajouter un animal
        </a>
        <button class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>📥</span> Exporter
        </button>
        <button class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>🖨️</span> Imprimer
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtres et recherche -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <form action="{{ route('admin.animals') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="lg:col-span-2">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Rechercher un animal..."
                            value="{{ request('search') }}"
                            class="w-full px-4 py-3 pl-12 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        >
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2">🔍</span>
                    </div>
                </div>

                <div>
                    <select name="species" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                        <option value="">Type d'animal</option>
                        @foreach($species as $specie)
                            <option value="{{ $specie->id }}" {{ request('species') == $specie->id ? 'selected' : '' }}>{{ $specie->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <select name="status" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                        <option value="">Statut</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Réservé</option>
                        <option value="adopted" {{ request('status') == 'adopted' ? 'selected' : '' }}>Adopté</option>
                        <option value="under_treatment" {{ request('status') == 'under_treatment' ? 'selected' : '' }}>En traitement</option>
                    </select>
                </div>

                <div>
                    <select name="sort" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                        <option value="recent" {{ request('sort') == 'recent' || !request('sort') ? 'selected' : '' }}>Plus récent</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus ancien</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom (A-Z)</option>
                        <option value="age_asc" {{ request('sort') == 'age_asc' ? 'selected' : '' }}>Âge (croissant)</option>
                        <option value="age_desc" {{ request('sort') == 'age_desc' ? 'selected' : '' }}>Âge (décroissant)</option>
                    </select>
                </div>
                
                <div class="lg:col-span-5 flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                        Filtrer
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Liste des animaux -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($animals as $animal)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}" alt="{{ $animal->name }}" class="w-full h-48 object-cover">
                    <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-sm
                        @if($animal->status == 'available') bg-green-100 text-green-800 @endif
                        @if($animal->status == 'reserved') bg-yellow-100 text-yellow-800 @endif
                        @if($animal->status == 'adopted') bg-blue-100 text-blue-800 @endif
                        @if($animal->status == 'under_treatment') bg-red-100 text-red-800 @endif
                        ">
                        {{ $animal->status == 'available' ? 'Disponible' : 
                          ($animal->status == 'reserved' ? 'Réservé' : 
                          ($animal->status == 'adopted' ? 'Adopté' : 'En traitement')) }}
                    </span>
                </div>

                <div class="p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-lg text-[#2F2E41]">{{ $animal->name }}</h3>
                            <p class="text-gray-600">{{ $animal->species->name }} - {{ $animal->breed }}</p>
                        </div>
                        <div class="dropdown relative">
                            <button class="text-gray-400 hover:text-gray-600 dropdown-toggle" id="dropdownMenuButton{{ $animal->id }}">⋮</button>
                            <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" id="dropdown{{ $animal->id }}">
                                <a href="{{ route('animals.edit', $animal) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Modifier</a>
                                <form action="{{ route('animals.destroy', $animal) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-gray-100" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Âge</p>
                            <p class="font-semibold text-[#2F2E41]">{{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Localisation</p>
                            <p class="font-semibold text-[#2F2E41]">{{ $animal->location }}</p>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('animals.edit', $animal) }}" class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] text-center">
                            Modifier
                        </a>
                        <a href="{{ route('animals.show', $animal) }}" class="px-4 py-2 border border-[#FFE3E3] rounded-xl hover:bg-[#FFE3E3] flex items-center justify-center">
                            👁️
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full p-8 bg-white rounded-2xl shadow-sm text-center">
                <p class="text-xl text-gray-600 mb-4">Aucun animal trouvé</p>
                <a href="{{ route('animals.create') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] inline-flex items-center gap-2">
                    <span>➕</span> Ajouter un animal
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($animals->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $animals->withQueryString()->links() }}
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        // Gestion des dropdowns pour les menus des animaux
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.dropdown-toggle');
            
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const id = this.id.replace('dropdownMenuButton', '');
                    const dropdown = document.getElementById('dropdown' + id);
                    dropdown.classList.toggle('hidden');
                });
            });
            
            // Ferme les dropdowns en cliquant ailleurs
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.dropdown')) {
                    const dropdowns = document.querySelectorAll('.dropdown-menu');
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.add('hidden');
                    });
                }
            });
        });
    </script>
@endpush
