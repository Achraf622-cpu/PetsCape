<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rencontrer Luna - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <style>
        body {
            font-family: 'Comfortaa', cursive;
        }
        .swiper-pagination-bullet-active {
            background: #FF6B6B !important;
        }
        .timeline-dot::before {
            content: '';
            position: absolute;
            left: -33px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #FF6B6B;
        }
    </style>
</head>
<body class="bg-[#FDFAF6]">
    <!-- Navigation (comme précédemment) -->

    <main class="pt-24 pb-12">
        <!-- En-tête avec retour -->
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <a href="#" class="inline-flex items-center gap-2 text-[#FF6B6B] hover:text-[#FF8787] mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour aux animaux
            </a>
        </div>

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Colonne gauche -->
                <div class="lg:w-2/3 space-y-8">
                    <!-- Galerie photos -->
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="path/to/luna1.jpg" alt="Luna" class="w-full h-[500px] object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="path/to/luna2.jpg" alt="Luna jouant" class="w-full h-[500px] object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="path/to/luna3.jpg" alt="Luna dormant" class="w-full h-[500px] object-cover">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <!-- Informations détaillées -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <h1 class="text-3xl font-bold text-[#2F2E41] mb-6">À propos de Luna</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Âge</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">2 ans</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Sexe</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">Femelle</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Race</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">Européen</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Poids</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">3.5 kg</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Histoire</h2>
                                <p class="text-gray-600 leading-relaxed">
                                    Luna a été trouvée dans les rues de Paris par nos bénévoles. Malgré son passé difficile,
                                    elle s'est révélée être une chatte extraordinairement douce et affectueuse. Elle adore 
                                    les câlins et ronronne dès qu'on s'approche d'elle.
                                </p>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Personnalité</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">Calme</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">Affectueuse</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">Sociable</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">Propre</span>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Santé</h2>
                                <div class="relative pl-8 border-l-2 border-[#FFE3E3] space-y-4">
                                    <div class="timeline-dot">
                                        <p class="text-gray-600">15/01/2024 - Stérilisation</p>
                                    </div>
                                    <div class="timeline-dot">
                                        <p class="text-gray-600">10/01/2024 - Vaccins à jour</p>
                                    </div>
                                    <div class="timeline-dot">
                                        <p class="text-gray-600">05/01/2024 - Puce électronique</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="lg:w-1/3 space-y-8">
                    <!-- Carte d'action -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm sticky top-24">
                        <div class="text-center space-y-4 mb-6">
                            <h2 class="text-2xl font-bold text-[#2F2E41]">Rencontrer Luna</h2>
                            <p class="text-gray-600">Remplissez le formulaire ci-dessous pour organiser une rencontre</p>
                        </div>

                        <form class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Date souhaitée</label>
                                <input type="date" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Créneau horaire</label>
                                <select class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none">
                                    <option>10:00 - 11:00</option>
                                    <option>11:00 - 12:00</option>
                                    <option>14:00 - 15:00</option>
                                    <option>15:00 - 16:00</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Message (optionnel)</label>
                                <textarea 
                                    rows="4" 
                                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                                    placeholder="Parlez-nous un peu de vous et de votre motivation..."
                                ></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                                Demander une rencontre
                            </button>
                        </form>

                        <div class="mt-6 p-4 bg-[#FFF5F5] rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                    📍
                                </div>
                                <div>
                                    <p class="font-semibold text-[#2F2E41]">Refuge PetsCape Paris</p>
                                    <p class="text-sm text-gray-600">123 rue des Animaux, 75001 Paris</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Initialisation du slider
        const swiper = new Swiper('.swiper', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            loop: true
        });

        // Validation du formulaire
        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const date = form.querySelector('input[type="date"]').value;
            const time = form.querySelector('select').value;

            if (!date) {
                alert('Veuillez sélectionner une date');
                return;
            }

            // Ajoutez ici votre logique d'envoi du formulaire
            console.log('Demande de rencontre envoyée :', { date, time });
        });
    </script>
</body>
</html>