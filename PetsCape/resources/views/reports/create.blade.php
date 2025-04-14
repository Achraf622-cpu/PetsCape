<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $isFound ? 'Signaler un animal trouvé' : 'Signaler un animal perdu' }} - PetsCape</title>
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
        <a href="{{ route('reports.index') }}" class="flex items-center text-[#FF6B6B] hover:text-[#FF8787]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour aux signalements
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h1 class="text-3xl font-bold text-[#2F2E41] mb-8">{{ $isFound ? 'Signaler un animal trouvé' : 'Signaler un animal perdu' }}</h1>
        
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
        
        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="is_found" value="{{ $isFound ? '1' : '0' }}">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Détails de l'animal -->
                <div>
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Détails de l'animal</h2>
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom de l'animal (si connu)</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ex: Rex">
                    </div>
                    
                    <div class="mb-4">
                        <label for="species_id" class="block text-sm font-medium text-gray-700 mb-2">Espèce</label>
                        <select id="species_id" name="species_id" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Sélectionnez une espèce</option>
                            @foreach($species as $specie)
                                <option value="{{ $specie->id }}" {{ old('species_id') == $specie->id ? 'selected' : '' }}>{{ $specie->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">Race (si connue)</label>
                        <input type="text" id="breed" name="breed" value="{{ old('breed') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ex: Labrador">
                    </div>
                    
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                        <select id="gender" name="gender" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Sélectionnez un genre</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Mâle</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femelle</option>
                            <option value="unknown" {{ old('gender') == 'unknown' ? 'selected' : '' }}>Inconnu</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Âge approximatif</label>
                        <input type="text" id="age" name="age" value="{{ old('age') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ex: 2 ans">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Décrivez l'animal et toute caractéristique distinctive...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Photo de l'animal</label>
                        <input type="file" id="image" name="image" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <p class="text-sm text-gray-500 mt-1">Formats acceptés: JPG, PNG. Taille max: 5MB</p>
                    </div>
                </div>
                
                <!-- Informations sur l'incident et coordonnées -->
                <div>
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Informations sur l'incident</h2>
                    
                    <div class="mb-4">
                        <label for="incident_date" class="block text-sm font-medium text-gray-700 mb-2">Date de {{ $isFound ? 'découverte' : 'disparition' }}</label>
                        <input type="date" id="incident_date" name="incident_date" value="{{ old('incident_date') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lieu</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ex: Rue des Lilas, Paris">
                    </div>
                    
                    <h2 class="text-xl font-bold text-[#2F2E41] mt-8 mb-4">Vos coordonnées</h2>
                    
                    <div class="mb-4">
                        <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" id="contact_name" name="contact_name" value="{{ old('contact_name', auth()->user()->name) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', auth()->user()->email) }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" placeholder="Ex: 06 12 34 56 78">
                    </div>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms_accepted" class="h-5 w-5 text-[#FF6B6B] border-2 border-[#FFE3E3] rounded focus:ring-[#FF6B6B]" {{ old('terms_accepted') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">J'accepte les conditions d'utilisation et la politique de confidentialité.</span>
                        </label>
                        @error('terms_accepted')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                    Soumettre le signalement
                </button>
            </div>
        </form>
    </div>
</main>
</body>
</html> 