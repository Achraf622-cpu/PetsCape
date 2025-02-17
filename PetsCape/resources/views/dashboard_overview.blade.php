<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - PetsCape Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Ajout de Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#FDFAF6]">
    <div class="min-h-screen flex">
        <!-- Contenu principal -->
        <main class="ml-64 flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-[#2F2E41]">Tableau de bord</h1>
                <p class="text-gray-600">Vue d'ensemble et statistiques</p>
            </div>

            <!-- Cartes récapitulatives -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Animaux présents -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600">Animaux présents</p>
                            <h3 class="text-2xl font-bold text-[#2F2E41] mt-2">42</h3>
                            <p class="text-green-500 text-sm mt-1">↑ +3 ce mois</p>
                        </div>
                        <span class="text-3xl">🐾</span>
                    </div>
                    <div class="mt-4 text-sm">
                        <span class="text-gray-600">28 chiens • 12 chats • 2 NAC</span>
                    </div>
                </div>

                <!-- Adoptions -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600">Adoptions du mois</p>
                            <h3 class="text-2xl font-bold text-[#2F2E41] mt-2">15</h3>
                            <p class="text-green-500 text-sm mt-1">↑ +20% vs mois dernier</p>
                        </div>
                        <span class="text-3xl">🏠</span>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-[#FF6B6B] h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>

                <!-- Rendez-vous -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600">Rendez-vous à venir</p>
                            <h3 class="text-2xl font-bold text-[#2F2E41] mt-2">8</h3>
                            <p class="text-[#FF6B6B] text-sm mt-1">Aujourd'hui : 3</p>
                        </div>
                        <span class="text-3xl">📅</span>
                    </div>
                    <div class="mt-4 text-sm">
                        <span class="text-gray-600">5 visites • 3 adoptions</span>
                    </div>
                </div>

                <!-- Taux d'occupation -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-600">Taux d'occupation</p>
                            <h3 class="text-2xl font-bold text-[#2F2E41] mt-2">85%</h3>
                            <p class="text-orange-500 text-sm mt-1">⚠️ Capacité limitée</p>
                        </div>
                        <span class="text-3xl">📊</span>
                    </div>
                    <div class="mt-4">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphiques -->
            <div class="grid grid-cols-2 gap-8 mb-8">
                <!-- Évolution des adoptions -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-[#2F2E41] mb-4">Évolution des adoptions</h3>
                    <canvas id="adoptionsChart" height="200"></canvas>
                </div>

                <!-- Répartition par espèce -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-[#2F2E41] mb-4">Répartition par espèce</h3>
                    <canvas id="especesChart" height="200"></canvas>
                </div>
            </div>

            <!-- Dernières activités -->
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-[#2F2E41]">Dernières activités</h3>
                    <button class="text-[#FF6B6B]">Voir tout →</button>
                </div>

                <div class="space-y-4">
                    <!-- Activité -->
                    <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-[#FFF5F5]">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center text-[#FF6B6B]">
                            🏠
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#2F2E41]">Luna a été adoptée</p>
                            <p class="text-sm text-gray-600">par Marie Martin</p>
                        </div>
                        <span class="text-sm text-gray-400">Il y a 2h</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-[#FFF5F5]">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center text-[#FF6B6B]">
                            🐾
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#2F2E41]">Nouvel arrivant : Max</p>
                            <p class="text-sm text-gray-600">Chien • 2 ans</p>
                        </div>
                        <span class="text-sm text-gray-400">Il y a 5h</span>
                    </div>

                    <div class="flex items-center gap-4 p-4 rounded-xl hover:bg-[#FFF5F5]">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center text-[#FF6B6B]">
                            💉
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-[#2F2E41]">Visite vétérinaire</p>
                            <p class="text-sm text-gray-600">3 animaux vaccinés</p>
                        </div>
                        <span class="text-sm text-gray-400">Hier</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Graphique des adoptions
        new Chart(document.getElementById('adoptionsChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Adoptions',
                    data: [12, 15, 18, 14, 20, 15],
                    borderColor: '#FF6B6B',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Graphique des espèces
        new Chart(document.getElementById('especesChart'), {
            type: 'doughnut',
            data: {
                labels: ['Chiens', 'Chats', 'NAC'],
                datasets: [{
                    data: [28, 12, 2],
                    backgroundColor: ['#FF6B6B', '#4ECDC4', '#FFE66D']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>