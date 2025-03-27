<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Espace - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #FFE3E3 0%, #FFF5F5 100%);
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
                <a href="#" class="text-[#2F2E41] hover:text-[#FF6B6B]">Adopter</a>
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
        <h1 class="text-3xl font-bold text-[#2F2E41]">Bienvenue, {{ auth()->user()->firstname }} !</h1>
        <p class="text-gray-600 mt-2">Voici votre espace personnel</p>
    </div>

    <!-- Cartes d'information -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Favoris -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-[#2F2E41]">Mes Favoris</h3>
                    <p class="text-3xl font-bold text-[#FF6B6B] mt-2">0</p>
                </div>
                <span class="text-2xl">❤️</span>
            </div>
            <a href="#" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-4 inline-block">
                Voir mes favoris →
            </a>
        </div>

        <!-- Rendez-vous -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-[#2F2E41]">Mes Rendez-vous</h3>
                    <p class="text-3xl font-bold text-[#FF6B6B] mt-2">0</p>
                </div>
                <span class="text-2xl">📅</span>
            </div>
            <a href="#" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-4 inline-block">
                Gérer mes rendez-vous →
            </a>
        </div>

        <!-- Messages -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="font-semibold text-[#2F2E41]">Messages</h3>
                    <p class="text-3xl font-bold text-[#FF6B6B] mt-2">0</p>
                </div>
                <span class="text-2xl">✉️</span>
            </div>
            <a href="#" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-4 inline-block">
                Voir mes messages →
            </a>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <h3 class="font-semibold text-[#2F2E41] mb-4">Actions rapides</h3>
        <div class="flex flex-wrap gap-4">
            <a href="#" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Découvrir les animaux
            </a>
            <a href="#" class="px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FFE3E3] transition-colors">
                Prendre rendez-vous
            </a>
            <a href="#" class="px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FFE3E3] transition-colors">
                Modifier mon profil
            </a>
        </div>
    </div>
</main>
</body>
</html>
