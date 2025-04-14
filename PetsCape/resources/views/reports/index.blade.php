<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signalements d'animaux - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .custom-shape {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    </style>
</head>
<body class="bg-[#FDFAF6] min-h-screen">
<!-- Navigation -->
<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-[#FF6B6B] custom-shape"></div>
                <span class="text-xl font-bold text-[#2F2E41]">PetsCape</span>
            </div>
            <div class="flex items-center gap-6">
                <a href="/" class="text-[#2F2E41] hover:text-[#FF6B6B]">Accueil</a>
                <a href="{{ route('animals.adoption') }}" class="text-[#2F2E41] hover:text-[#FF6B6B]">Adopter</a>
                <a href="{{ route('dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B]">Tableau de bord</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[#FF6B6B] hover:text-[#FF8787]">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<main class="max-w-7xl mx-auto px-6 py-8">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-[#2F2E41]">Signalements d'animaux</h1>
            <p class="text-gray-600 mt-2">Retrouvez tous les signalements d'animaux perdus et trouvés</p>
        </div>
        <div class="flex space-x-4">
            <a href="{{ route('reports.create', ['type' => 'lost']) }}" class="px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                Signaler un animal perdu
            </a>
            <a href="{{ route('reports.create', ['type' => 'found']) }}" class="px-4 py-2 bg-[#4ECDC4] text-white rounded-xl hover:bg-[#3DBDB4]">
                Signaler un animal trouvé
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <form action="{{ route('reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select id="type" name="type" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    <option value="">Tous</option>
                    <option value="lost" {{ request('type') === 'lost' ? 'selected' : '' }}>Perdus</option>
                    <option value="found" {{ request('type') === 'found' ? 'selected' : '' }}>Trouvés</option>
                </select>
            </div>
            <div>
                <label for="species" class="block text-sm font-medium text-gray-700 mb-2">Espèce</label>
                <select id="species" name="species" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    <option value="">Toutes</option>
                    @foreach($species as $specie)
                        <option value="{{ $specie->id }}" {{ request('species') == $specie->id ? 'selected' : '' }}>{{ $specie->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lieu</label>
                <input type="text" id="location" name="location" value="{{ request('location') }}" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ville, département...">
            </div>
            <div class="flex items-end">
                <button type="submit" class="px-4 py-2 bg-[#2F2E41] text-white rounded-xl hover:bg-[#3F3E52] w-full">
                    Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Liste des signalements -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($reports as $report)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="relative">
                    @if($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->name ?: 'Animal' }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Pas d'image</span>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 text-sm font-medium {{ $report->is_found ? 'bg-[#4ECDC4] text-white' : 'bg-[#FF6B6B] text-white' }} rounded-full">
                            {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-[#2F2E41]">{{ $report->name ?: ($report->species ? $report->species->name : 'Animal') }}</h3>
                        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-gray-600 mb-2">{{ $report->species ? $report->species->name : '' }}{{ $report->breed ? ' • ' . $report->breed : '' }}</p>
                    <p class="text-gray-600 mb-4">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $report->location }}
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm {{ $report->is_resolved ? 'text-[#4ECDC4]' : 'text-gray-600' }}">
                            {{ $report->is_resolved ? 'Résolu' : 'En attente' }}
                        </span>
                        <a href="{{ route('reports.show', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787] text-sm font-medium">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 py-12">
                <div class="text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-500 mb-2">Aucun signalement trouvé</h3>
                    <p class="text-gray-400">Ajustez vos filtres ou créez un nouveau signalement</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $reports->links() }}
    </div>
</main>
</body>
</html> 