@extends('admin.layouts.master')

@section('title', 'Gestion des Animaux')
@section('page-title', 'Gestion des Animaux')
@section('page-subtitle', 'Liste de tous les animaux disponibles')

@section('content')
    <!-- Actions principales -->
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('animals.create') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2">
            <span>➕</span> Ajouter un animal
        </a>
        <button class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>📥</span> Exporter
        </button>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <form action="{{ route('animals.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
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
                    @foreach($species ?? [] as $specie)
                        <option value="{{ $specie->id }}" {{ request('species') == $specie->id ? 'selected' : '' }}>
                            {{ $specie->name }}
                        </option>
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
                <button type="submit" class="w-full px-4 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 p-4 mb-8 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    ✓
                </div>
                <div class="ml-3">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Liste des animaux -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($animals as $animal)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="relative">
                    <img
                        src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}"
                        alt="{{ $animal->name }}"
                        class="w-full h-48 object-cover"
                    >
                    <!-- Debug info -->
                    @if(app()->environment('local'))
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 text-white p-1 text-xs overflow-hidden">
                            Path: {{ $animal->image ?? 'No image' }} <br>
                            URL: {{ $animal->image ? asset('storage/'.$animal->image) : 'N/A' }}
                        </div>
                    @endif
                    <!-- End debug info -->
                    <span class="absolute top-4 right-4 px-3 py-1
                        @if($animal->status === 'available') bg-green-100 text-green-800
                        @elseif($animal->status === 'reserved') bg-yellow-100 text-yellow-800
                        @elseif($animal->status === 'adopted') bg-blue-100 text-blue-800
                        @else bg-red-100 text-red-800 @endif
                        rounded-full text-sm">
                        {{ ucfirst($animal->status) }}
                    </span>
                </div>

                <div class="p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="font-bold text-lg text-[#2F2E41]">{{ $animal->name }}</h3>
                            <p class="text-gray-600">{{ $animal->species->name ?? 'N/A' }} • {{ $animal->age }} an(s)</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('animals.edit', $animal) }}" class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white">
                                ✏️
                            </a>
                            <form action="{{ route('animals.destroy', $animal) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span>🏠</span> {{ $animal->location }}
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600">
                            <span>🐾</span> {{ $animal->breed }}
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('animals.show', $animal) }}" class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-10">
                <div class="text-3xl mb-4">🐾</div>
                <h3 class="text-xl font-bold text-[#2F2E41]">Aucun animal trouvé</h3>
                <p class="text-gray-600">Essayez de modifier vos filtres ou ajoutez un nouvel animal</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $animals->links() }}
    </div>
@endsection
