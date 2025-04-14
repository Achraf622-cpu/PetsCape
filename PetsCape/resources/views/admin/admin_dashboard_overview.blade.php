@extends('admin.layouts.master')

@section('title', 'Dashboard Admin')
@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Bienvenue sur votre espace administrateur')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Total Animaux</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">{{ $totalAnimals ?? 124 }}</h3>
                </div>
                <span class="text-2xl">🐾</span>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm">↑ +12% </span>
                <span class="text-gray-600 text-sm">vs mois dernier</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Adoptions en cours</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">{{ $ongoingAdoptions ?? 28 }}</h3>
                </div>
                <span class="text-2xl">📝</span>
            </div>
            <div class="mt-4">
                <span class="text-green-500 text-sm">↑ +5% </span>
                <span class="text-gray-600 text-sm">vs mois dernier</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Rendez-vous aujourd'hui</p>
                    <h3 class="text-2xl font-bold text-[#2F2E41]">{{ $todayAppointments ?? 12 }}</h3>
                </div>
                <span class="text-2xl">📅</span>
            </div>
            <div class="mt-4">
                <span class="text-yellow-500 text-sm">→ Stable</span>
                <span class="text-gray-600 text-sm">vs hier</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600">Signalements actifs</p>
                    <h3 class="text-2xl font-bold text-[#FF6B6B]">{{ $activeReports ?? 3 }}</h3>
                </div>
                <span class="text-2xl">🚨</span>
            </div>
            <div class="mt-4">
                <span class="text-red-500 text-sm">! Requiert attention</span>
            </div>
        </div>
    </div>

    <!-- Sections principales -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Derniers rendez-vous -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#2F2E41]">Rendez-vous du jour</h2>
                <a href="{{ route('admin.appointments') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout →</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-center gap-4 p-4 rounded-xl bg-[#FFF5F5]">
                    <div class="w-12 h-12 rounded-xl bg-[#FFE3E3] flex items-center justify-center">
                        🐱
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-[#2F2E41]">Luna & Marie Martin</h3>
                        <p class="text-sm text-gray-600">14:00 - Première rencontre</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 rounded-xl bg-white text-[#FF6B6B]">✓</button>
                        <button class="p-2 rounded-xl bg-white text-[#FF6B6B]">✕</button>
                    </div>
                </div>
                <!-- Autres rendez-vous... -->
            </div>
        </div>

        <!-- Derniers signalements -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-[#2F2E41]">Signalements récents</h2>
                <a href="{{ route('admin.reports') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout →</a>
            </div>
            <div class="space-y-4">
                <div class="p-4 rounded-xl border-l-4 border-[#FF6B6B] bg-[#FFF5F5]">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-[#2F2E41]">Max - Animal perdu</h3>
                            <p class="text-sm text-gray-600">Signalé par: Jean Dupont</p>
                            <p class="text-sm text-gray-600">Il y a 2 heures</p>
                        </div>
                        <button class="px-4 py-2 bg-[#FF6B6B] text-white rounded-xl">
                            Traiter
                        </button>
                    </div>
                </div>
                <!-- Autres signalements... -->
            </div>
        </div>

        <!-- Statistiques d'adoption -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Statistiques d'adoption</h2>
            <div class="h-64 bg-gray-100 rounded-xl flex items-center justify-center">
                [Graphique des adoptions]
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Actions rapides</h2>
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('animals.create') }}" class="p-4 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors text-center">
                    ➕ Ajouter un animal
                </a>
                <a href="{{ route('admin.appointments') }}" class="p-4 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors text-center">
                    📅 Planifier un RDV
                </a>
                <a href="{{ route('admin.reports') }}" class="p-4 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors text-center">
                    📊 Rapport mensuel
                </a>
                <button class="p-4 rounded-xl bg-[#FFE3E3] text-[#FF6B6B] hover:bg-[#FF6B6B] hover:text-white transition-colors">
                    ✉️ Newsletter
                </button>
            </div>
        </div>
    </div>
@endsection