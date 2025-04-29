<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report->name ?? ($report->is_found ? 'Animal trouvé' : 'Animal perdu') }} - PetsCape</title>
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
    <div class="mb-6">
        <a href="{{ route('reports.index') }}" class="flex items-center text-[#FF6B6B] hover:text-[#FF8787]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour aux signalements
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <!-- Image section -->
            <div class="h-full">
                @if($report->image)
                    <img src="{{ asset('storage/' . $report->image) }}" alt="{{ $report->name ?? 'Animal signalé' }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full min-h-[300px] bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">Aucune image</span>
                    </div>
                @endif
            </div>
            
            <!-- Informations section -->
            <div class="p-8">
                <div class="flex items-center gap-4 mb-6">
                    <span class="px-3 py-1 rounded-full {{ $report->is_found ? 'bg-blue-500' : 'bg-orange-500' }} text-white text-sm font-bold">
                        {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                    </span>
                    <span class="px-3 py-1 rounded-full {{ 
                        $report->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                        ($report->status === 'resolved' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') 
                    }}">
                        {{ 
                            $report->status === 'pending' ? 'En attente' : 
                            ($report->status === 'resolved' ? 'Résolu' : 'Fermé') 
                        }}
                    </span>
                    <span class="px-3 py-1 rounded-full bg-[#FFE3E3] text-[#FF6B6B]">
                        {{ $report->species->name }}
                    </span>
                </div>
                
                <h1 class="text-3xl font-bold text-[#2F2E41] mb-4">{{ $report->name ?? ($report->is_found ? 'Animal trouvé' : 'Animal perdu') }}</h1>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    @if($report->breed)
                        <div>
                            <span class="text-gray-500">Race</span>
                            <p class="font-medium text-lg">{{ $report->breed }}</p>
                        </div>
                    @endif
                    
                    @if($report->age)
                        <div>
                            <span class="text-gray-500">Âge</span>
                            <p class="font-medium text-lg">{{ $report->age }}</p>
                        </div>
                    @endif
                    
                    @if($report->gender)
                        <div>
                            <span class="text-gray-500">Genre</span>
                            <p class="font-medium text-lg">{{ $report->gender }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <span class="text-gray-500">Lieu</span>
                        <p class="font-medium text-lg">{{ $report->location }}</p>
                    </div>
                    
                    <div>
                        <span class="text-gray-500">Date du signalement</span>
                        <p class="font-medium text-lg">{{ $report->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#2F2E41] mb-2">Description</h3>
                    <p class="text-gray-600">{{ $report->description }}</p>
                </div>
                
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-[#2F2E41] mb-2">Informations de contact</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-500">Nom</span>
                            <p class="font-medium">{{ $report->contact_name }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Email</span>
                            <p class="font-medium">{{ $report->contact_email }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Téléphone</span>
                            <p class="font-medium">{{ $report->contact_phone }}</p>
                        </div>
                    </div>
                </div>
                
                @if(auth()->id() === $report->user_id)
                    <div class="border-t pt-6 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('reports.edit', $report) }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] text-center">
                            Modifier le signalement
                        </a>
                        
                        @if($report->status === 'pending')
                            <form action="{{ route('reports.change-status', $report) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full px-6 py-3 border-2 border-green-500 text-green-500 rounded-xl hover:bg-green-50 text-center">
                                    Marquer comme résolu
                                </button>
                                <input type="hidden" name="status" value="resolved">
                            </form>
                        @endif
                        
                        <form action="{{ route('reports.destroy', $report) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-3 border-2 border-red-500 text-red-500 rounded-xl hover:bg-red-50 text-center">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Section commentaire -->
    <div class="mt-8 bg-white rounded-2xl shadow-sm p-8">
        <h2 class="text-2xl font-bold text-[#2F2E41] mb-6">Avez-vous des informations?</h2>
        
        <div class="mb-8">
            @if(isset($report->comments) && count($report->comments) > 0)
                @foreach($report->comments as $comment)
                    <div class="border-b last:border-b-0 py-4">
                        <div class="flex justify-between items-start mb-2">
                            <div class="font-bold">{{ $comment->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <p class="text-gray-600">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 italic">Aucun commentaire pour le moment.</p>
            @endif
        </div>
        
        <form action="{{ route('reports.comments.store', $report) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Ajouter un commentaire</label>
                <textarea id="content" name="content" rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Partagez des informations qui pourraient aider..."></textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</main>
</body>
</html> 