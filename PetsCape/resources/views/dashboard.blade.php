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

<!-- Contenu principal -->
<main class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#2F2E41]">Bienvenue, {{ auth()->user()->name }} !</h1>
        <p class="text-gray-600 mt-2">Voici votre espace personnel</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Cartes principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Signaler un animal perdu -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-xl bg-[#FFE3E3] flex items-center justify-center text-2xl">
                    😿
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-[#2F2E41]">Animal perdu ?</h2>
                    <p class="text-gray-600">Signalez la disparition de votre animal</p>
                </div>
            </div>
            <p class="text-gray-600 mb-6">
                Si votre animal a disparu, publiez un signalement pour augmenter vos chances de le retrouver. Incluez une photo et des détails précis.
            </p>
            <a href="{{ route('reports.create', ['type' => 'lost']) }}" class="w-full block text-center px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Signaler un animal perdu
            </a>
        </div>

        <!-- Signaler un animal trouvé -->
        <div class="bg-white p-6 rounded-2xl shadow-sm">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-xl bg-[#FFE3E3] flex items-center justify-center text-2xl">
                    🐾
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-[#2F2E41]">Animal trouvé ?</h2>
                    <p class="text-gray-600">Signalez un animal sans abri</p>
                </div>
            </div>
            <p class="text-gray-600 mb-6">
                Vous avez trouvé un animal sans collier ou sans refuge ? Partagez les informations pour aider à retrouver son propriétaire.
            </p>
            <a href="{{ route('reports.create', ['type' => 'found']) }}" class="w-full block text-center px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Signaler un animal trouvé
            </a>
        </div>
    </div>

    <!-- Mes signalements -->
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

    <!-- Derniers signalements -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
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

    <!-- Actions rapides -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <h3 class="font-semibold text-[#2F2E41] mb-4">Actions rapides</h3>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('animals.adoption') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Découvrir les animaux
            </a>
            <a href="{{ route('reports.create', ['type' => 'lost']) }}" class="px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FFE3E3] transition-colors">
                Signaler un animal perdu
            </a>
            <a href="{{ route('reports.create', ['type' => 'found']) }}" class="px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] rounded-xl hover:bg-[#FFE3E3] transition-colors">
                Signaler un animal trouvé
            </a>
        </div>
    </div>
</main>
</body>
</html>
