<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Animaux - PetsCape Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FDFAF6]">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-sm fixed h-full">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <img src="path/to/logo.png" alt="PetsCape" class="w-8 h-8">
                    <span class="font-bold text-xl text-[#2F2E41]">PetsCape</span>
                </div>

                <nav class="space-y-2">
                    <a href="#dashboard" class="flex items-center gap-3 p-3 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">
                        📊 Tableau de bord
                    </a>
                    <a href="#animaux" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                        🐾 Animaux
                    </a>
                    <a href="#rendez-vous" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                        📅 Rendez-vous
                    </a>
                    <a href="#adoptions" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                        📝 Adoptions
                    </a>
                    <a href="#utilisateurs" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                        👥 Utilisateurs
                    </a>
                    <a href="#signalements" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-[#FFE3E3] hover:text-[#FF6B6B]">
                        🚨 Signalements
                    </a>
                </nav>
            </div>
        </aside>
        <!-- Contenu principal -->
        <main class="ml-64 flex-1 p-8">
            <!-- Header avec recherche et filtres -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#2F2E41]">Gestion des Animaux</h1>
                    <p class="text-gray-600">Gérez tous les animaux du refuge</p>
                </div>
                
                <button 
                    onclick="openAddAnimalModal()"
                    class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2"
                >
                    <span>➕</span> Ajouter un animal
                </button>
            </div>

            <!-- Filtres et recherche -->
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input 
                            type="text" 
                            placeholder="Rechercher un animal..."
                            class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        >
                    </div>
                    <div>
                        <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Type d'animal</option>
                            <option value="chien">Chien</option>
                            <option value="chat">Chat</option>
                            <option value="nac">NAC</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Statut</option>
                            <option value="disponible">Disponible</option>
                            <option value="reserve">Réservé</option>
                            <option value="adopte">Adopté</option>
                            <option value="quarantaine">En quarantaine</option>
                        </select>
                    </div>
                    <div>
                        <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            <option value="">Trier par</option>
                            <option value="recent">Plus récent</option>
                            <option value="ancien">Plus ancien</option>
                            <option value="age">Âge</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Liste des animaux -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Carte animal -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="path/to/luna.jpg" alt="Luna" class="w-full h-48 object-cover">
                        <span class="absolute top-4 right-4 px-3 py-1 bg-green-500 text-white rounded-full text-sm">
                            Disponible
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-[#2F2E41] text-lg">Luna</h3>
                                <p class="text-gray-600">Chatte • 2 ans</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white">
                                    ✏️
                                </button>
                                <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white">
                                    🗑️
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span>🏥</span> Stérilisée, Vaccinée
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span>📍</span> Box 12
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span>📅</span> Arrivée le 01/03/2024
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                                Voir détails
                            </button>
                            <button class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white">
                                📅 RDV
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Répéter pour d'autres animaux -->
            </div>
        </main>
    </div>

    <!-- Modal Ajout/Modification d'animal -->
    <div id="animalModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-[#2F2E41]">Ajouter un animal</h2>
                        <button onclick="closeAnimalModal()" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>

                    <form class="space-y-6">
                        <!-- Informations de base -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                <input type="text" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                                <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                    <option value="chien">Chien</option>
                                    <option value="chat">Chat</option>
                                    <option value="nac">NAC</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Âge</label>
                                <input type="number" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sexe</label>
                                <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                    <option value="M">Mâle</option>
                                    <option value="F">Femelle</option>
                                </select>
                            </div>
                        </div>

                        <!-- Santé -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">État de santé</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="rounded text-[#FF6B6B]">
                                    <span>Vacciné</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="rounded text-[#FF6B6B]">
                                    <span>Stérilisé</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="rounded text-[#FF6B6B]">
                                    <span>Pucé</span>
                                </label>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="4" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"></textarea>
                        </div>

                        <!-- Localisation -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Box/Emplacement</label>
                            <input type="text" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        </div>

                        <!-- Photos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Photos</label>
                            <div class="border-2 border-dashed border-[#FFE3E3] rounded-xl p-8 text-center">
                                <div class="space-y-2">
                                    <div class="text-4xl">📸</div>
                                    <p class="text-gray-600">Glissez-déposez vos photos ici ou</p>
                                    <button type="button" class="text-[#FF6B6B] hover:text-[#FF8787]">parcourez vos fichiers</button>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                                Enregistrer
                            </button>
                            <button type="button" onclick="closeAnimalModal()" class="flex-1 px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddAnimalModal() {
            document.getElementById('animalModal').classList.remove('hidden');
        }

        function closeAnimalModal() {
            document.getElementById('animalModal').classList.add('hidden');
        }
    </script>
</body>
</html>