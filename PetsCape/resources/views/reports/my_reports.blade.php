<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Signalements - PetsCape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Comfortaa', cursive;
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
                <a href="{{ route('dashboard') }}" class="text-[#2F2E41] hover:text-[#FF6B6B]">Tableau de bord</a>
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

<!-- Main content -->
<main class="max-w-7xl mx-auto px-6 py-8">
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-[#2F2E41]">Mes Signalements</h1>
            <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nouveau signalement
            </a>
        </div>
        <p class="text-gray-600 mt-2">Gérez vos signalements d'animaux perdus et trouvés</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm p-6">
        @if(count($reports) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left pb-4 font-semibold text-gray-600">Type</th>
                            <th class="text-left pb-4 font-semibold text-gray-600">Espèce</th>
                            <th class="text-left pb-4 font-semibold text-gray-600">Localisation</th>
                            <th class="text-left pb-4 font-semibold text-gray-600">Date</th>
                            <th class="text-left pb-4 font-semibold text-gray-600">Statut</th>
                            <th class="text-left pb-4 font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr class="border-t border-gray-100">
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-sm {{ $report->is_found ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                                    </span>
                                </td>
                                <td class="py-4">{{ $report->species->name ?? 'Non spécifié' }}</td>
                                <td class="py-4">{{ $report->location }}</td>
                                <td class="py-4">{{ $report->date_reported->format('d/m/Y') }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-sm
                                        {{ $report->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $report->status === 'resolved' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $report->status === 'cancelled' ? 'bg-gray-100 text-gray-700' : '' }}">
                                        {{ $report->status === 'pending' ? 'En attente' :
                                        ($report->status === 'resolved' ? 'Résolu' : 'Annulé') }}
                                    </span>
                                </td>
                                <td class="py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('reports.show', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Voir</a>
                                        <a href="{{ route('reports.edit', $report) }}" class="text-[#FF6B6B] hover:text-[#FF8787]">Modifier</a>
                                        
                                        @if($report->status === 'pending')
                                            <form action="{{ route('reports.change-status', $report) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="resolved">
                                                <button type="submit" class="text-green-600 hover:text-green-800">Marquer comme résolu</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $reports->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <div class="w-24 h-24 bg-[#FFE3E3] rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#FF6B6B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#2F2E41] mb-2">Aucun signalement</h2>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore créé de signalements d'animaux perdus ou trouvés.</p>
                <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] inline-flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Créer un signalement
                </a>
            </div>
        @endif
    </div>
</main>
</body>
</html> 