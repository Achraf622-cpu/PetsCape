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
        .sidebar-link {
            @apply flex items-center py-3 px-4 border-b border-gray-200 text-[#2F2E41] transition-colors;
        }
        .sidebar-link:hover {
            @apply bg-[#FFF5F5];
        }
        .sidebar-link.active {
            @apply bg-[#FFE3E3] text-[#FF6B6B] font-semibold;
        }
        .icon-container {
            @apply mr-3 flex-shrink-0;
        }
        .sidebar-section {
            @apply mb-2 pb-2 border-b border-gray-100;
        }
        .sidebar-section-title {
            @apply text-xs uppercase text-gray-500 font-semibold px-4 py-2;
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
                <a href="{{ route('reports.index') }}" class="text-[#2F2E41] hover:text-[#FF6B6B]">Signalements</a>
                <a href="{{ route('settings.index') }}" class="text-[#2F2E41] hover:text-[#FF6B6B]">Paramètres</a>
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

<!-- Main Container -->
<div class="flex max-w-7xl mx-auto px-6 py-8 gap-8">
    <!-- Sidebar -->
    <div class="w-64 flex-shrink-0">
        <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-8">
            <!-- User Profile Summary -->
            <div class="flex flex-col items-center mb-6 pb-6 border-b border-gray-100">
                <div class="w-20 h-20 bg-[#FFE3E3] rounded-full mb-3 flex items-center justify-center text-2xl font-bold text-[#FF6B6B]">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <h2 class="font-bold text-[#2F2E41]">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                <a href="{{ route('settings.index') }}" class="mt-3 text-sm text-[#FF6B6B] hover:text-[#FF8787] flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Modifier mon profil
                </a>
            </div>
            
            <!-- Sidebar Navigation -->
            <div class="space-y-2 mt-6">
                <a href="#" class="sidebar-link active" data-section="dashboard">
                    <svg class="sidebar-icon text-[#36B9CC]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2 13h6v8H2v-8zm7-10h6v18H9V3zm7 5h6v13h-6V8z" />
                    </svg>
                    Tableau de bord
                </a>
                <a href="#" class="sidebar-link" data-section="signalements">
                    <svg class="sidebar-icon text-[#E74A3B]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.5,1L2,6V8H23V6M11.5,9.5L6,12.5V22H17V12.5L11.5,9.5Z" />
                    </svg>
                    Mes signalements
                </a>
                <a href="#" class="sidebar-link" data-section="adoptions">
                    <svg class="sidebar-icon text-[#F6C23E]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                    </svg>
                    Mes adoptions
                </a>
                <a href="#" class="sidebar-link" data-section="favoris">
                    <svg class="sidebar-icon text-[#E63946]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                    </svg>
                    Mes favoris
                </a>
                <a href="#" class="sidebar-link" data-section="rendez-vous">
                    <svg class="sidebar-icon text-[#4E73DF]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7,12H9V14H7V12M21,6V20A2,2 0 0,1 19,22H5C3.89,22 3,21.1 3,20V6A2,2 0 0,1 5,4H6V2H8V4H16V2H18V4H19A2,2 0 0,1 21,6M5,8H19V6H5V8M19,20V10H5V20H19M15,14V12H17V14H15M11,14V12H13V14H11M7,16H9V18H7V16M15,18V16H17V18H15M11,18V16H13V18H11Z" />
                    </svg>
                    Mes rendez-vous
                </a>
                <a href="#" class="sidebar-link" data-section="recents">
                    <svg class="sidebar-icon text-[#6610F2]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M16.2,16.2L11,13V7H12.5V12.2L17,14.9L16.2,16.2Z" />
                    </svg>
                    Animaux récents
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Section: Dashboard (default view) -->
        <div id="dashboard-section" class="space-y-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h1 class="text-2xl font-bold text-[#2F2E41]">Bienvenue, {{ auth()->user()->name }} !</h1>
                <p class="text-gray-600 mt-2">Voici votre tableau de bord personnel</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-[#FFE3E3] rounded-xl p-4 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-[#2F2E41]">Signalements</h3>
                        <p class="text-sm text-gray-700">{{ count($myReports) }}</p>
                    </div>
                    
                    <div class="bg-[#FFE3E3] rounded-xl p-4 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-[#2F2E41]">Favoris</h3>
                        <p class="text-sm text-gray-700">0</p>
                    </div>
                    
                    <div class="bg-[#FFE3E3] rounded-xl p-4 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF6B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-[#2F2E41]">Rendez-vous</h3>
                        <p class="text-sm text-gray-700">0</p>
                    </div>
                </div>
            </div>

            <!-- Derniers signalements -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Animaux perdus récents -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-[#2F2E41]">Animaux perdus récents</h2>
                        <a href="{{ route('reports.index', ['type' => 'lost']) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout →</a>
                    </div>

                    @if(count($lostReports) > 0)
                        <div class="space-y-4">
                            @foreach($lostReports as $report)
                                <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-[#FFF5F5] transition-colors">
                                    <img src="{{ $report->image ? asset('storage/'.$report->image) : asset('images/default-pet.jpg') }}" alt="Animal" class="w-16 h-16 object-cover rounded-xl">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-bold text-[#2F2E41]">{{ $report->name ?: $report->species->name }}</h3>
                                            <span class="text-sm text-gray-600">
                                                @if ($report instanceof \App\Models\AnimalReport)
                                                    {{ $report->date_reported->diffForHumans() }}
                                                @else
                                                    {{ $report->date_of_incident ? $report->date_of_incident->diffForHumans() : $report->created_at->diffForHumans() }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $report->location }}</p>
                                        @if ($report instanceof \App\Models\AnimalReport)
                                            <a href="{{ route('reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @else
                                            <a href="{{ route('old-reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-4">Aucun animal perdu signalé récemment.</p>
                    @endif
                </div>

                <!-- Animaux trouvés récents -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-[#2F2E41]">Animaux trouvés récents</h2>
                        <a href="{{ route('reports.index', ['type' => 'found']) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout →</a>
                    </div>

                    @if(count($foundReports) > 0)
                        <div class="space-y-4">
                            @foreach($foundReports as $report)
                                <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-[#FFF5F5] transition-colors">
                                    <img src="{{ $report->image ? asset('storage/'.$report->image) : asset('images/default-pet.jpg') }}" alt="Animal" class="w-16 h-16 object-cover rounded-xl">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-bold text-[#2F2E41]">{{ $report->name ?: $report->species->name }}</h3>
                                            <span class="text-sm text-gray-600">
                                                @if ($report instanceof \App\Models\AnimalReport)
                                                    {{ $report->date_reported->diffForHumans() }}
                                                @else
                                                    {{ $report->date_of_incident ? $report->date_of_incident->diffForHumans() : $report->created_at->diffForHumans() }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $report->location }}</p>
                                        @if ($report instanceof \App\Models\AnimalReport)
                                            <a href="{{ route('reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @else
                                            <a href="{{ route('old-reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-4">Aucun animal trouvé signalé récemment.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Section: Mes signalements (hidden by default) -->
        <div id="signalements-section" class="hidden">
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-[#2F2E41]">Mes signalements</h2>
                    <a href="{{ route('reports.my') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir tout →</a>
                </div>

                @if(count($myReports) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Type</th>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Espèce</th>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Localisation</th>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Date</th>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Statut</th>
                                    <th class="text-left pb-3 font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($myReports as $report)
                                    <tr class="border-t border-gray-100">
                                        <td class="py-3">
                                            <span class="px-3 py-1 rounded-full text-sm {{ $report->is_found ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                                            </span>
                                        </td>
                                        <td class="py-3">{{ $report->species->name }}</td>
                                        <td class="py-3">{{ $report->location }}</td>
                                        <td class="py-3">
                                            @if ($report instanceof \App\Models\AnimalReport)
                                                {{ $report->date_reported->format('d/m/Y') }}
                                            @else
                                                {{ $report->date_of_incident ? $report->date_of_incident->format('d/m/Y') : $report->created_at->format('d/m/Y') }}
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            @if ($report instanceof \App\Models\AnimalReport)
                                                <span class="px-3 py-1 rounded-full text-sm 
                                                    {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                                    {{ $report->status === 'resolved' ? 'bg-green-100 text-green-700' : '' }}
                                                    {{ $report->status === 'cancelled' ? 'bg-gray-100 text-gray-700' : '' }}">
                                                    {{ $report->status === 'pending' ? 'En attente' : 
                                                    ($report->status === 'resolved' ? 'Résolu' : 'Annulé') }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-sm 
                                                    {{ !$report->is_resolved ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                                    {{ $report->is_resolved ? 'Résolu' : 'En attente' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            @if ($report instanceof \App\Models\AnimalReport)
                                                <a href="{{ route('reports.show', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787] mr-2">Voir</a>
                                                <a href="{{ route('reports.edit', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Modifier</a>
                                            @else
                                                <a href="{{ route('old-reports.show', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787] mr-2">Voir</a>
                                                <a href="{{ route('old-reports.edit', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Modifier</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600 text-center py-4">Vous n'avez pas encore créé de signalements.</p>
                @endif
            </div>
        </div>

        <!-- Section: Mes adoptions (hidden by default) -->
        <div id="adoptions-section" class="hidden">
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes adoptions</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <p class="text-gray-600 text-center py-4 col-span-3">Vous n'avez pas encore d'adoptions.</p>
                </div>
            </div>
        </div>

        <!-- Section: Mes favoris (hidden by default) -->
        <div id="favoris-section" class="hidden">
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes favoris</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <p class="text-gray-600 text-center py-4 col-span-3">Vous n'avez pas encore d'animaux favoris.</p>
                </div>
            </div>
        </div>

        <!-- Section: Mes rendez-vous (hidden by default) -->
        <div id="rendez-vous-section" class="hidden">
            <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Mes rendez-vous</h2>

                <div class="space-y-4">
                    <p class="text-gray-600 text-center py-4">Vous n'avez pas de rendez-vous à venir.</p>
                </div>
            </div>
        </div>

        <!-- Section: Animaux récents (hidden by default) -->
        <div id="recents-section" class="hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Animaux perdus récents -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Animaux perdus récents</h2>

                    @if(count($lostReports) > 0)
                        <div class="space-y-4">
                            @foreach($lostReports as $report)
                                <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-[#FFF5F5] transition-colors">
                                    <img src="{{ $report->image ? asset('storage/'.$report->image) : asset('images/default-pet.jpg') }}" alt="Animal" class="w-16 h-16 object-cover rounded-xl">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-bold text-[#2F2E41]">{{ $report->name ?: $report->species->name }}</h3>
                                            <span class="text-sm text-gray-600">
                                                @if ($report instanceof \App\Models\AnimalReport)
                                                    {{ $report->date_reported->diffForHumans() }}
                                                @else
                                                    {{ $report->date_of_incident ? $report->date_of_incident->diffForHumans() : $report->created_at->diffForHumans() }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $report->location }}</p>
                                        @if ($report instanceof \App\Models\AnimalReport)
                                            <a href="{{ route('reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @else
                                            <a href="{{ route('old-reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-4">Aucun animal perdu signalé récemment.</p>
                    @endif
                </div>

                <!-- Animaux trouvés récents -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Animaux trouvés récents</h2>

                    @if(count($foundReports) > 0)
                        <div class="space-y-4">
                            @foreach($foundReports as $report)
                                <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-[#FFF5F5] transition-colors">
                                    <img src="{{ $report->image ? asset('storage/'.$report->image) : asset('images/default-pet.jpg') }}" alt="Animal" class="w-16 h-16 object-cover rounded-xl">
                                    <div class="flex-1">
                                        <div class="flex justify-between">
                                            <h3 class="font-bold text-[#2F2E41]">{{ $report->name ?: $report->species->name }}</h3>
                                            <span class="text-sm text-gray-600">
                                                @if ($report instanceof \App\Models\AnimalReport)
                                                    {{ $report->date_reported->diffForHumans() }}
                                                @else
                                                    {{ $report->date_of_incident ? $report->date_of_incident->diffForHumans() : $report->created_at->diffForHumans() }}
                                                @endif
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1">{{ $report->location }}</p>
                                        @if ($report instanceof \App\Models\AnimalReport)
                                            <a href="{{ route('reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @else
                                            <a href="{{ route('old-reports.show', $report) }}" class="text-sm text-[#FF6B6B] hover:text-[#FF8787] mt-2 inline-block">Voir plus</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600 text-center py-4">Aucun animal trouvé signalé récemment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple navigation without page refresh
    document.addEventListener('DOMContentLoaded', function() {
        const sections = {
            'dashboard': document.getElementById('dashboard-section'),
            'signalements': document.getElementById('signalements-section'),
            'adoptions': document.getElementById('adoptions-section'),
            'favoris': document.getElementById('favoris-section'),
            'rendez-vous': document.getElementById('rendez-vous-section'),
            'recents': document.getElementById('recents-section')
        };
        
        const links = document.querySelectorAll('.sidebar-link');
        
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Hide all sections
                Object.values(sections).forEach(section => {
                    section.classList.add('hidden');
                });
                
                // Remove active class from all links
                links.forEach(l => l.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show selected section
                const sectionName = this.getAttribute('data-section');
                sections[sectionName].classList.remove('hidden');
            });
        });
    });
</script>
</body>
</html>
