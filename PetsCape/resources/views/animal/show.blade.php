@extends('admin.layouts.master')

@section('title', $animal->name . ' - Détails')
@section('page-title', 'Détails de l\'animal')
@section('page-subtitle', $animal->name . ' - ' . $animal->breed)

@section('content')
    <!-- Actions rapides -->
    <div class="flex flex-wrap gap-4 mb-8">
        <a href="{{ route('animals.edit', $animal) }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2">
            <span>✏️</span> Modifier
        </a>
        <form action="{{ route('animals.destroy', $animal) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-3 bg-white text-red-600 rounded-xl hover:bg-red-50 flex items-center gap-2 border border-red-300">
                <span>🗑️</span> Supprimer
            </button>
        </form>
        <a href="{{ route('animals.index') }}" class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>←</span> Retour à la liste
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Informations principales -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Image et informations de base -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <img
                    src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}"
                    alt="{{ $animal->name }}"
                    class="w-full h-80 object-cover"
                >

                <div class="p-6">
                    <div class="flex flex-wrap justify-between items-start mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-[#2F2E41]">{{ $animal->name }}</h1>
                            <p class="text-gray-600">{{ $animal->species->name ?? 'N/A' }} • {{ $animal->breed }}</p>
                        </div>

                        <div class="px-4 py-2
                            @if($animal->status === 'available') bg-green-100 text-green-800
                            @elseif($animal->status === 'reserved') bg-yellow-100 text-yellow-800
                            @elseif($animal->status === 'adopted') bg-blue-100 text-blue-800
                            @else bg-red-100 text-red-800 @endif
                            rounded-full">
                            {{ ucfirst($animal->status) }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                            <p class="text-sm text-gray-600">Âge</p>
                            <p class="font-bold text-[#FF6B6B]">{{ $animal->age }} an(s)</p>
                        </div>
                        <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                            <p class="text-sm text-gray-600">Espèce</p>
                            <p class="font-bold text-[#FF6B6B]">{{ $animal->species->name ?? 'N/A' }}</p>
                        </div>
                        <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                            <p class="text-sm text-gray-600">Race</p>
                            <p class="font-bold text-[#FF6B6B]">{{ $animal->breed }}</p>
                        </div>
                        <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                            <p class="text-sm text-gray-600">Emplacement</p>
                            <p class="font-bold text-[#FF6B6B]">{{ $animal->location }}</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Description</h2>
                        <p class="text-gray-600 leading-relaxed">{{ $animal->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Historique des rendez-vous -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Historique des rendez-vous</h2>

                @if($animal->appointments && $animal->appointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($animal->appointments as $appointment)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50">
                                <div class="w-12 h-12 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                                    <span class="text-[#FF6B6B]">📅</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#2F2E41]">{{ $appointment->user->firstname ?? 'Utilisateur' }} {{ $appointment->user->lastname ?? '' }}</h3>
                                    <p class="text-sm text-gray-600">{{ $appointment->date_time->format('d/m/Y à H:i') }}</p>
                                </div>
                                <span class="px-3 py-1 text-sm
                                    @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-blue-100 text-blue-800 @endif
                                    rounded-full">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <div class="text-4xl mb-4">📅</div>
                        <h3 class="text-lg font-bold text-[#2F2E41]">Aucun rendez-vous</h3>
                        <p class="text-gray-600">Cet animal n'a pas encore eu de rendez-vous</p>
                    </div>
                @endif
            </div>

            <!-- Demandes d'adoption -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-6">Demandes d'adoption</h2>

                @if($animal->adoptionRequests && $animal->adoptionRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($animal->adoptionRequests as $request)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50">
                                <div class="w-12 h-12 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                                    <span class="text-[#FF6B6B]">📝</span>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#2F2E41]">{{ $request->user->firstname ?? 'Utilisateur' }} {{ $request->user->lastname ?? '' }}</h3>
                                    <p class="text-sm text-gray-600">Demande soumise le {{ $request->created_at->format('d/m/Y') }}</p>
                                </div>
                                <span class="px-3 py-1 text-sm
                                    @if($request->status === 'approved') bg-green-100 text-green-800
                                    @elseif($request->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif
                                    rounded-full">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <div class="text-4xl mb-4">📝</div>
                        <h3 class="text-lg font-bold text-[#2F2E41]">Aucune demande d'adoption</h3>
                        <p class="text-gray-600">Cet animal n'a pas encore reçu de demande d'adoption</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Panneau latéral d'actions -->
        <div class="lg:col-span-4 space-y-8">
            <!-- Informations de base -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Informations</h2>

                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Date d'arrivée:</span>
                        <span class="font-medium">{{ $animal->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">ID:</span>
                        <span class="font-medium">#{{ $animal->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Dernière mise à jour:</span>
                        <span class="font-medium">{{ $animal->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Actions</h2>

                <div class="space-y-4">
                    <a href="{{ route('animals.edit', $animal) }}" class="block w-full py-3 bg-[#FF6B6B] text-white text-center rounded-xl hover:bg-[#FF8787]">
                        Modifier
                    </a>

                    <button class="block w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] text-center rounded-xl hover:bg-[#FF6B6B] hover:text-white">
                        Planifier un rendez-vous
                    </button>

                    <button class="block w-full py-3 bg-[#FFE3E3] text-[#FF6B6B] text-center rounded-xl hover:bg-[#FF6B6B] hover:text-white">
                        Créer une demande d'adoption
                    </button>

                    <button class="block w-full py-3 border border-gray-300 text-gray-600 text-center rounded-xl hover:bg-gray-50">
                        Imprimer la fiche
                    </button>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-bold text-[#2F2E41] mb-4">Statistiques</h2>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                            <span class="text-[#FF6B6B]">👁️</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Nombre de visites</p>
                            <p class="font-bold text-[#2F2E41]">0</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                            <span class="text-[#FF6B6B]">📅</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Rendez-vous</p>
                            <p class="font-bold text-[#2F2E41]">{{ $animal->appointments->count() ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#FFE3E3] rounded-full flex items-center justify-center">
                            <span class="text-[#FF6B6B]">📝</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Demandes d'adoption</p>
                            <p class="font-bold text-[#2F2E41]">{{ $animal->adoptionRequests->count() ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
