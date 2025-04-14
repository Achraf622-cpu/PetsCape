<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du signalement - PetsCape</title>
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
<main class="max-w-4xl mx-auto px-6 py-8">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="flex items-center text-[#FF6B6B] hover:text-[#FF8787]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour au tableau de bord
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <div class="flex justify-between items-start mb-8">
            <div>
                <span class="px-3 py-1 rounded-full text-sm inline-block mb-2 {{ $report->is_found ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                    {{ $report->is_found ? 'Animal trouvé' : 'Animal perdu' }}
                </span>
                <h1 class="text-3xl font-bold text-[#2F2E41]">{{ $report->name ?: 'Sans nom' }}</h1>
                <p class="text-gray-600 mt-1">{{ $report->species->name }}</p>
            </div>
            <div>
                <span class="px-3 py-1 rounded-full text-sm inline-block {{ $report->is_resolved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ $report->is_resolved ? 'Résolu' : 'En attente' }}
                </span>
                @if($report->user_id === auth()->id())
                    <div class="mt-2 flex">
                        <a href="{{ route('old-reports.edit', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787] mr-4">Modifier</a>
                        <form action="{{ route('old-reports.destroy', $report) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement?')">Supprimer</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Image et informations -->
            <div>
                @if($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->name }}" class="w-full h-80 object-cover rounded-xl mb-6">
                @else
                    <div class="w-full h-80 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
                        <span class="text-gray-400 text-5xl">🐾</span>
                    </div>
                @endif

                <div class="bg-[#FFF5F5] p-6 rounded-xl">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Informations sur l'animal</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($report->breed)
                            <div>
                                <p class="text-sm text-gray-500">Race</p>
                                <p class="font-medium">{{ $report->breed }}</p>
                            </div>
                        @endif
                        
                        @if($report->gender)
                            <div>
                                <p class="text-sm text-gray-500">Genre</p>
                                <p class="font-medium">
                                    @if($report->gender === 'male')
                                        Mâle
                                    @elseif($report->gender === 'female')
                                        Femelle
                                    @else
                                        {{ $report->gender }}
                                    @endif
                                </p>
                            </div>
                        @endif
                        
                        @if($report->age)
                            <div>
                                <p class="text-sm text-gray-500">Âge</p>
                                <p class="font-medium">{{ $report->age }}</p>
                            </div>
                        @endif
                        
                        <div>
                            <p class="text-sm text-gray-500">Date du signalement</p>
                            <p class="font-medium">{{ $report->created_at->format('d/m/Y') }}</p>
                        </div>
                        
                        @if($report->date_of_incident)
                            <div>
                                <p class="text-sm text-gray-500">Date de {{ $report->is_found ? 'découverte' : 'disparition' }}</p>
                                <p class="font-medium">{{ $report->date_of_incident->format('d/m/Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Description et contact -->
            <div>
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-2">Description</h2>
                    <p class="text-gray-600 whitespace-pre-line">{{ $report->description }}</p>
                </div>
                
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-2">Lieu</h2>
                    <p class="text-gray-600">{{ $report->location }}</p>
                </div>
                
                <div class="bg-[#FFF5F5] p-6 rounded-xl mb-6">
                    <h2 class="text-lg font-bold text-[#2F2E41] mb-4">Contact</h2>
                    
                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <p class="text-sm text-gray-500">Nom</p>
                            <p class="font-medium">{{ $report->contact_name }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $report->contact_email }}</p>
                        </div>
                        
                        <div>
                            <p class="text-sm text-gray-500">Téléphone</p>
                            <p class="font-medium">{{ $report->contact_phone }}</p>
                        </div>
                    </div>
                </div>
                
                @if(!$report->is_resolved && $report->user_id === auth()->id())
                    <form action="{{ route('old-reports.changeStatus', $report) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="is_resolved" value="1">
                        <button type="submit" class="w-full px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors">
                            Marquer comme résolu
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</main>
</body>
</html> 