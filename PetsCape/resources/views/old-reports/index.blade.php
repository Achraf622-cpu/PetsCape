<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signalements - PetsCape</title>
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
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#2F2E41]">Signalements d'animaux (Ancien système)</h1>
        <p class="text-gray-600 mt-1">Consultez les signalements d'animaux perdus et trouvés</p>
    </div>

    <!-- Filtres -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <form action="{{ route('old-reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select id="type" name="type" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    <option value="">Tous les types</option>
                    <option value="lost" {{ request('type') == 'lost' ? 'selected' : '' }}>Animaux perdus</option>
                    <option value="found" {{ request('type') == 'found' ? 'selected' : '' }}>Animaux trouvés</option>
                </select>
            </div>
            
            <div>
                <label for="species_id" class="block text-sm font-medium text-gray-700 mb-1">Espèce</label>
                <select id="species_id" name="species_id" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    <option value="">Toutes les espèces</option>
                    @foreach($species as $specie)
                        <option value="{{ $specie->id }}" {{ request('species_id') == $specie->id ? 'selected' : '' }}>{{ $specie->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Localisation</label>
                <input type="text" id="location" name="location" value="{{ request('location') }}" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ville, quartier...">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Filtrer
                </button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Liste des signalements -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($reports as $report)
            <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="relative">
                    @if($report->image)
                        <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->name }}" class="w-full h-48 object-cover rounded-xl mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded-xl flex items-center justify-center mb-4">
                            <span class="text-gray-400 text-5xl">🐾</span>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-sm {{ $report->is_found ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                        {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                    </span>
                    @if($report->is_resolved)
                        <span class="absolute top-3 right-3 px-3 py-1 rounded-full text-sm bg-green-100 text-green-700">
                            Résolu
                        </span>
                    @endif
                </div>
                
                <h3 class="text-xl font-bold text-[#2F2E41] mb-1">{{ $report->name ?: 'Sans nom' }}</h3>
                <p class="text-gray-600 mb-2">{{ $report->species->name }}</p>
                
                <div class="flex items-center mb-3">
                    <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-sm text-gray-600">{{ $report->location }}</span>
                </div>
                
                <div class="flex items-center mb-4">
                    <svg class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm text-gray-600">{{ $report->date_of_incident ? $report->date_of_incident->format('d/m/Y') : $report->created_at->format('d/m/Y') }}</span>
                </div>
                
                <a href="{{ route('old-reports.show', $report) }}" class="w-full block text-center px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Voir les détails
                </a>
            </div>
        @empty
            <div class="col-span-3 bg-white p-6 rounded-2xl shadow-sm text-center">
                <p class="text-gray-600">Aucun signalement trouvé correspondant aux critères.</p>
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