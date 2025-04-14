<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe - PetsCape</title>
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
        <a href="{{ route('settings.index') }}" class="flex items-center text-[#FF6B6B] hover:text-[#FF8787]">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Retour aux paramètres
        </a>
    </div>

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#2F2E41]">Changer le mot de passe</h1>
        <p class="text-gray-600 mt-1">Mettez à jour votre mot de passe pour sécuriser votre compte</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Panneau de navigation -->
        <div class="col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="space-y-2">
                    <a href="{{ route('settings.profile') }}" class="block px-4 py-3 rounded-xl hover:bg-[#FFF5F5] text-[#2F2E41] hover:text-[#FF6B6B]">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil
                        </div>
                    </a>
                    
                    <a href="{{ route('settings.password') }}" class="block px-4 py-3 rounded-xl bg-[#FFF5F5] text-[#FF6B6B]">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Mot de passe
                        </div>
                    </a>
                    
                    <a href="{{ route('settings.account') }}" class="block px-4 py-3 rounded-xl hover:bg-[#FFF5F5] text-[#2F2E41] hover:text-[#FF6B6B]">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Compte
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Formulaire de mot de passe -->
        <div class="col-span-1 md:col-span-2">
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <h2 class="text-2xl font-bold text-[#2F2E41] mb-6">Changer votre mot de passe</h2>
                
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
                
                <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                        <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                        <p class="mt-1 text-sm text-gray-500">Minimum 8 caractères</p>
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
                
                <div class="mt-8 border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-semibold text-[#2F2E41] mb-3">Mot de passe oublié ?</h3>
                    <p class="text-gray-600 mb-4">
                        Si vous avez oublié votre mot de passe actuel, vous pouvez demander une réinitialisation.
                    </p>
                    <a href="{{ route('password.request') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">
                        Réinitialiser mon mot de passe →
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html> 