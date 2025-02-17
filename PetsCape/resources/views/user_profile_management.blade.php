<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-[#FDFAF6]">
    <main class="pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <!-- En-tête -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#2F2E41]">Mon Profil</h1>
                <p class="text-gray-600">Gérez vos informations personnelles</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations personnelles -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Informations personnelles</h2>
                        <form class="space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                                    <input type="text" value="Marie" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                                    <input type="text" value="Martin" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" value="marie.martin@email.com" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                                <input type="tel" value="06 12 34 56 78" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                                <textarea class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">123 rue des Fleurs, 75001 Paris</textarea>
                            </div>

                            <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                                Sauvegarder les modifications
                            </button>
                        </form>
                    </div>

                    <!-- Sécurité -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Sécurité</h2>
                        <form class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                                <input type="password" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                                <input type="password" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>

                            <button type="submit" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                                Modifier le mot de passe
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Animaux adoptés et signalements -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes animaux adoptés</h2>
                        
                        <!-- Liste des animaux adoptés -->
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-[#FFF5F5]">
                                <div class="flex items-center gap-4 mb-3">
                                    <img src="path/to/luna.jpg" alt="Luna" class="w-16 h-16 rounded-xl object-cover">
                                    <div>
                                        <h3 class="font-bold text-[#2F2E41]">Luna</h3>
                                        <p class="text-sm text-gray-600">Adoptée le 15/01/2024</p>
                                    </div>
                                </div>
                                
                                <button 
                                    class="w-full px-4 py-2 text-sm border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white transition-colors"
                                    onclick="openSignalementModal('Luna')"
                                >
                                    Signaler un problème
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal de signalement -->
    <div id="signalementModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-6 max-w-lg w-full mx-4">
            <h3 class="text-xl font-bold text-[#2F2E41] mb-4">Signalement pour <span id="animalName"></span></h3>
            
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de signalement</label>
                    <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        <option value="perdu">Animal perdu</option>
                        <option value="retrouve">Animal retrouvé</option>
                        <option value="rendre">Souhait de rendre l'animal</option>
                        <option value="sante">Problème de santé</option>
                        <option value="comportement">Problème de comportement</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description détaillée</label>
                    <textarea 
                        rows="4"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        placeholder="Décrivez la situation en détail..."
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date de l'incident</label>
                    <input type="date" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photos (optionnel)</label>
                    <input type="file" multiple class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                        Envoyer le signalement
                    </button>
                    <button 
                        type="button" 
                        onclick="closeSignalementModal()"
                        class="flex-1 px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white"
                    >
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSignalementModal(animalName) {
            document.getElementById('signalementModal').classList.remove('hidden');
            document.getElementById('animalName').textContent = animalName;
        }

        function closeSignalementModal() {
            document.getElementById('signalementModal').classList.add('hidden');
        }
    </script>
</body>
</html>