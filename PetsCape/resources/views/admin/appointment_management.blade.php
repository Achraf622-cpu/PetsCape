<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Rendez-vous - PetsCape Admin</title>
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
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-[#2F2E41]">Gestion des Rendez-vous</h1>
                    <p class="text-gray-600">Planning et suivi des visites</p>
                </div>
                
                <button 
                    onclick="openAddRdvModal()"
                    class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2"
                >
                    <span>📅</span> Nouveau rendez-vous
                </button>
            </div>

            <!-- Vue calendrier et liste -->
            <div class="grid grid-cols-3 gap-8">
                <!-- Calendrier -->
                <div class="col-span-2 bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-[#2F2E41]">Mars 2024</h2>
                        <div class="flex gap-2">
                            <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">←</button>
                            <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">→</button>
                        </div>
                    </div>

                    <!-- Grille du calendrier -->
                    <div class="grid grid-cols-7 gap-4">
                        <!-- Jours de la semaine -->
                        <div class="text-center font-bold text-gray-600">Lun</div>
                        <div class="text-center font-bold text-gray-600">Mar</div>
                        <div class="text-center font-bold text-gray-600">Mer</div>
                        <div class="text-center font-bold text-gray-600">Jeu</div>
                        <div class="text-center font-bold text-gray-600">Ven</div>
                        <div class="text-center font-bold text-gray-600">Sam</div>
                        <div class="text-center font-bold text-gray-600">Dim</div>

                        <!-- Jours du mois -->
                        <!-- Exemple pour quelques jours -->
                        <div class="h-24 p-2 border rounded-xl">
                            <span class="text-gray-400">1</span>
                        </div>
                        <div class="h-24 p-2 border rounded-xl">
                            <span>2</span>
                            <div class="mt-1 text-xs bg-[#FFE3E3] text-[#FF6B6B] p-1 rounded">
                                2 RDV
                            </div>
                        </div>
                        <div class="h-24 p-2 border rounded-xl bg-[#FF6B6B] text-white">
                            <span>3</span>
                            <div class="mt-1 text-xs bg-white text-[#FF6B6B] p-1 rounded">
                                5 RDV
                            </div>
                        </div>
                        <!-- Continuer pour les autres jours... -->
                    </div>
                </div>

                <!-- Liste des RDV du jour -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Rendez-vous du jour</h2>
                    
                    <div class="space-y-4">
                        <!-- RDV -->
                        <div class="p-4 rounded-xl bg-[#FFF5F5] border-l-4 border-[#FF6B6B]">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-bold">10:00</span>
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs">
                                    Confirmé
                                </span>
                            </div>
                            <h3 class="font-bold text-[#2F2E41]">Visite de Luna</h3>
                            <p class="text-sm text-gray-600">Marie Martin</p>
                            <p class="text-sm text-gray-600">Première rencontre</p>
                            <div class="flex gap-2 mt-2">
                                <button class="px-3 py-1 bg-[#FF6B6B] text-white rounded-xl text-sm">
                                    Modifier
                                </button>
                                <button class="px-3 py-1 bg-white text-[#FF6B6B] rounded-xl text-sm">
                                    Annuler
                                </button>
                            </div>
                        </div>

                        <!-- Autres RDV... -->
                    </div>
                </div>
            </div>

            <!-- Prochains rendez-vous -->
            <div class="mt-8 bg-white p-6 rounded-2xl shadow-sm">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Prochains rendez-vous</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-4">Date/Heure</th>
                                <th class="pb-4">Visiteur</th>
                                <th class="pb-4">Animal</th>
                                <th class="pb-4">Type</th>
                                <th class="pb-4">Statut</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <tr class="border-b">
                                <td class="py-4">04/03 - 14:00</td>
                                <td>Pierre Durand</td>
                                <td>Max</td>
                                <td>Visite</td>
                                <td>
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded-full text-xs">
                                        En attente
                                    </span>
                                </td>
                                <td class="flex gap-2">
                                    <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">✓</button>
                                    <button class="p-2 rounded-xl bg-[#FFE3E3] text-[#FF6B6B]">✕</button>
                                </td>
                            </tr>
                            <!-- Autres rendez-vous... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Nouveau Rendez-vous -->
    <div id="rdvModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-xl w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-[#2F2E41]">Nouveau rendez-vous</h2>
                        <button onclick="closeRdvModal()" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>

                    <form class="space-y-6">
                        <!-- Date et heure -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Heure</label>
                                <input type="time" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>
                        </div>

                        <!-- Visiteur -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Visiteur</label>
                            <input type="text" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                        </div>

                        <!-- Animal -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Animal</label>
                            <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                <option value="">Sélectionner un animal</option>
                                <option value="luna">Luna</option>
                                <option value="max">Max</option>
                            </select>
                        </div>

                        <!-- Type de visite -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de visite</label>
                            <select class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                <option value="premiere">Première rencontre</option>
                                <option value="suivi">Visite de suivi</option>
                                <option value="adoption">Adoption finale</option>
                            </select>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <textarea rows="3" class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"></textarea>
                        </div>

                        <!-- Boutons -->
                        <div class="flex gap-4">
                            <button type="submit" class="flex-1 px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                                Enregistrer
                            </button>
                            <button type="button" onclick="closeRdvModal()" class="flex-1 px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FF6B6B] hover:text-white">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddRdvModal() {
            document.getElementById('rdvModal').classList.remove('hidden');
        }

        function closeRdvModal() {
            document.getElementById('rdvModal').classList.add('hidden');
        }
    </script>
</body>
</html>