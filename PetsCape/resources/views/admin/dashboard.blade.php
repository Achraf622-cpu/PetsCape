@extends('admin.layouts.master')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Vue d\'ensemble de votre refuge')

@section('content')
    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Carte - Total Animaux -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Total Animaux</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">124</h3>
                </div>
                <span class="text-2xl">🐾</span>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm">↑ +5% </span>
                <span class="text-gray-600 text-sm">vs mois dernier</span>
            </div>
        </div>

        <!-- Carte - Adoptions -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Adoptions ce mois</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">28</h3>
                </div>
                <span class="text-2xl">💝</span>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm">↑ +12% </span>
                <span class="text-gray-600 text-sm">vs mois dernier</span>
            </div>
        </div>

        <!-- Carte - Rendez-vous -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Rendez-vous aujourd'hui</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">8</h3>
                </div>
                <span class="text-2xl">📅</span>
            </div>
            <div class="mt-4">
                <span class="text-gray-600 text-sm">5 confirmés</span>
            </div>
        </div>

        <!-- Carte - Visiteurs -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Visiteurs aujourd'hui</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">45</h3>
                </div>
                <span class="text-2xl">👥</span>
            </div>
            <div class="mt-4">
                <span class="text-red-500 text-sm">↓ -8% </span>
                <span class="text-gray-600 text-sm">vs hier</span>
            </div>
        </div>
    </div>

    <!-- Graphiques et Listes -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Graphique des adoptions -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-[#2F2E41]">Adoptions récentes</h3>
                <select class="px-3 py-2 border rounded-xl">
                    <option>7 derniers jours</option>
                    <option>30 derniers jours</option>
                    <option>Cette année</option>
                </select>
            </div>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-xl">
                [Graphique des adoptions]
            </div>
        </div>

        <!-- Liste des rendez-vous -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-[#2F2E41]">Prochains rendez-vous</h3>
                <button class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout</button>
            </div>

            <div class="space-y-4">
                <!-- Rendez-vous -->
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-[#FFE3E3] rounded-xl flex items-center justify-center">
                        <span class="text-xl">👋</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-[#2F2E41]">Visite de Max le Berger Allemand</p>
                        <p class="text-sm text-gray-600">Aujourd'hui à 14:30</p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Confirmé</span>
                </div>

                <!-- Répétez pour d'autres rendez-vous -->
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-xl">
                    <div class="w-12 h-12 bg-[#FFE3E3] rounded-xl flex items-center justify-center">
                        <span class="text-xl">🐱</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-[#2F2E41]">Adoption de Luna</p>
                        <p class="text-sm text-gray-600">Demain à 10:00</p>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">En attente</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers animaux -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-[#2F2E41]">Derniers animaux ajoutés</h3>
            <button class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Carte Animal -->
            <div class="bg-white p-4 rounded-2xl shadow-sm">
                <img src="/images/dog1.jpg" alt="Rex" class="w-full h-48 object-cover rounded-xl mb-4">
                <h4 class="font-bold text-[#2F2E41]">Rex</h4>
                <p class="text-sm text-gray-600">Berger Allemand • 2 ans</p>
                <span class="inline-block mt-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Disponible</span>
            </div>

            <!-- Répétez pour d'autres animaux -->
        </div>
    </div>
@endsection
