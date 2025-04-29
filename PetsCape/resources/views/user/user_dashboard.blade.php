<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Tableau de Bord - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Comfortaa', cursive; }
    </style>
</head>
<body class="bg-[#FDFAF6]">
    <!-- Navigation (comme précédemment) -->

    <main class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar -->
                <div class="md:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">
                        <!-- Profil résumé -->
                        <div class="flex items-center gap-4 pb-6 border-b border-gray-100">
                            <div class="w-16 h-16 rounded-full bg-[#FFE3E3] flex items-center justify-center">
                                <span class="text-2xl">👤</span>
                            </div>
                            <div>
                                <h2 class="font-bold text-[#2F2E41]">Marie Martin</h2>
                                <p class="text-sm text-gray-600">marie.martin@email.com</p>
                            </div>
                        </div>

                        <!-- Menu -->
                        <nav class="mt-6 space-y-2">
                            <a href="#rendez-vous" class="flex items-center gap-3 p-3 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">
                                <span>📅</span>
                                Mes rendez-vous
                            </a>
                            <a href="#favoris" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                                <span>❤️</span>
                                Mes favoris
                            </a>
                            <a href="#profil" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                                <span>⚙️</span>
                                Paramètres du profil
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Contenu principal -->
                <div class="md:w-3/4 space-y-8">
                    <!-- En-tête -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h1 class="text-2xl font-bold text-[#2F2E41] mb-2">Bonjour Marie 👋</h1>
                        <p class="text-gray-600">Voici un aperçu de vos activités sur PetsCape</p>
                    </div>

                    <!-- Statistiques -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="text-4xl mb-3">📅</div>
                            <h3 class="font-bold text-[#2F2E41]">3</h3>
                            <p class="text-sm text-gray-600">Rendez-vous à venir</p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="text-4xl mb-3">❤️</div>
                            <h3 class="font-bold text-[#2F2E41]">5</h3>
                            <p class="text-sm text-gray-600">Animaux en favoris</p>
                        </div>
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="text-4xl mb-3">✨</div>
                            <h3 class="font-bold text-[#2F2E41]">1</h3>
                            <p class="text-sm text-gray-600">Adoption en cours</p>
                        </div>
                    </div>

                    <!-- Rendez-vous -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes prochains rendez-vous</h2>
                        <div class="space-y-4">
                            <!-- Rendez-vous à venir -->
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF5F5]">
                                <div class="w-16 h-16 rounded-xl overflow-hidden">
                                    <img src="path/to/luna.jpg" alt="Luna" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#2F2E41]">Luna</h3>
                                    <p class="text-sm text-gray-600">Demain à 14:00</p>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 rounded-xl bg-white text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                        ✏️
                                    </button>
                                    <button class="p-2 rounded-xl bg-white text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                        ❌
                                    </button>
                                </div>
                            </div>

                            <!-- Autres rendez-vous -->
                            <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50">
                                <div class="w-16 h-16 rounded-xl overflow-hidden">
                                    <img src="path/to/max.jpg" alt="Max" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#2F2E41]">Max</h3>
                                    <p class="text-sm text-gray-600">15 mars 2024 à 11:00</p>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                        ✏️
                                    </button>
                                    <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors">
                                        ❌
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Favoris -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes favoris</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Carte animal favori -->
                            <div class="flex gap-4 p-4 rounded-xl hover:bg-gray-50">
                                <div class="w-20 h-20 rounded-xl overflow-hidden">
                                    <img src="path/to/felix.jpg" alt="Félix" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#2F2E41]">Félix</h3>
                                    <p class="text-sm text-gray-600">Chat • 1 an</p>
                                    <div class="mt-2">
                                        <a href="#" class="text-sm text-[#FF6B6B] hover:text-[#FF8787]">
                                            Voir le profil →
                                        </a>
                                    </div>
                                </div>
                                <button class="text-[#FF6B6B] hover:text-[#FF8787]">
                                    ❤️
                                </button>
                            </div>
                            <!-- Répéter pour d'autres favoris -->
                        </div>
                    </div>

                    <!-- Historique des adoptions -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes adoptions</h2>
                        <div class="relative pl-8 border-l-2 border-[#FFE3E3] space-y-6">
                            <div class="relative">
                                <div class="absolute -left-[41px] top-0 w-6 h-6 bg-[#FF6B6B] rounded-full"></div>
                                <div class="bg-[#FFF5F5] p-4 rounded-xl">
                                    <h3 class="font-bold text-[#2F2E41]">Adoption en cours - Milo</h3>
                                    <p class="text-sm text-gray-600">Dossier soumis le 1er mars 2024</p>
                                    <div class="mt-2">
                                        <span class="px-3 py-1 text-sm bg-[#FFE3E3] text-[#FF6B6B] rounded-full">
                                            En attente de validation
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>