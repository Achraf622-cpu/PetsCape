<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le signalement - PetsCape</title>
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
        <a href="{{ route('old-reports.show', $report) }}" class="flex items-center text-[#FF6B6B] hover:text-[#FF8787]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour au signalement
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h1 class="text-3xl font-bold text-[#2F2E41] mb-8">Modifier le signalement</h1>
        
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="text-red-500 font-bold mb-2">Des erreurs sont survenues :</div>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('old-reports.update', $report) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Détails de l'animal -->
                <div>
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Détails de l'animal</h2>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de l'animal</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $report->name) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="species_id" class="block text-sm font-medium text-gray-700 mb-2">Espèce</label>
                        <select id="species_id" name="species_id" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                            <option value="">Sélectionnez une espèce</option>
                            @foreach($species as $specie)
                                <option value="{{ $specie->id }}" {{ old('species_id', $report->species_id) == $specie->id ? 'selected' : '' }}>{{ $specie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">Race (si connue)</label>
                        <input type="text" id="breed" name="breed" value="{{ old('breed', $report->breed) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                        <select id="gender" name="gender" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Sélectionnez un genre</option>
                            <option value="male" {{ old('gender', $report->gender) == 'male' ? 'selected' : '' }}>Mâle</option>
                            <option value="female" {{ old('gender', $report->gender) == 'female' ? 'selected' : '' }}>Femelle</option>
                            <option value="unknown" {{ old('gender', $report->gender) == 'unknown' ? 'selected' : '' }}>Inconnu</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Âge approximatif</label>
                        <input type="text" id="age" name="age" value="{{ old('age', $report->age) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>{{ old('description', $report->description) }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Photo de l'animal</label>
                        @if($report->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $report->image) }}" alt="Image actuelle" class="w-32 h-32 object-cover rounded-lg">
                                <p class="text-sm text-gray-500 mt-1">Image actuelle</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <p class="text-sm text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle</p>
                    </div>
                </div>
                
                <!-- Informations sur l'incident et coordonnées -->
                <div>
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Informations sur l'incident</h2>
                    
                    <div class="mb-4">
                        <label for="is_resolved" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                        <select id="is_resolved" name="is_resolved" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                            <option value="0" {{ old('is_resolved', $report->is_resolved) ? '' : 'selected' }}>En attente</option>
                            <option value="1" {{ old('is_resolved', $report->is_resolved) ? 'selected' : '' }}>Résolu</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="date_of_incident" class="block text-sm font-medium text-gray-700 mb-2">Date de {{ $report->is_found ? 'découverte' : 'disparition' }}</label>
                        <input type="date" id="date_of_incident" name="date_of_incident" value="{{ old('date_of_incident', $report->date_of_incident ? $report->date_of_incident->format('Y-m-d') : '') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lieu</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $report->location) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                    </div>
                    
                    <h2 class="text-xl font-bold text-[#2F2E41] mt-8 mb-4">Coordonnées</h2>
                    
                    <div class="mb-4">
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name', $report->contact_name) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $report->contact_email) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $report->contact_phone) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <a href="{{ route('old-reports.show', $report) }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 mr-4">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</main>
</body>
</html> 