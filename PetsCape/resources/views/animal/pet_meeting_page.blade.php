@extends('layouts.index')

@section('title', 'Rencontrer ' . $animal->name)

@section('content')
    <main class="pt-28 pb-12">
        <!-- En-tête avec retour -->
        <div class="max-w-7xl mx-auto px-6 mb-8">
            <div class="flex items-center text-sm mb-4">
                <a href="/" class="text-gray-600 hover:text-[#FF6B6B]">Accueil</a>
                <span class="mx-2 text-gray-400">›</span>
                <a href="{{ route('animals.adoption') }}" class="text-gray-600 hover:text-[#FF6B6B]">Adoption</a>
                <span class="mx-2 text-gray-400">›</span>
                <span class="text-[#FF6B6B]">{{ $animal->name }}</span>
            </div>
            <a href="{{ route('animals.adoption') }}" class="inline-flex items-center gap-2 text-[#FF6B6B] hover:text-[#FF8787] mb-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
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
                        <img src="{{ $animal->image ? asset('storage/'.$animal->image) : asset('images/default-animal.jpg') }}"
                             alt="{{ $animal->name }}"
                             class="w-full h-[500px] object-cover">
                    </div>

                    <!-- Informations détaillées -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm">
                        <h1 class="text-3xl font-bold text-[#2F2E41] mb-6">À propos de {{ $animal->name }}</h1>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Âge</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Espèce</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->species->name }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Race</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->breed }}</p>
                            </div>
                            <div class="text-center p-4 bg-[#FFF5F5] rounded-xl">
                                <p class="text-sm text-gray-600">Localisation</p>
                                <p class="text-lg font-bold text-[#FF6B6B]">{{ $animal->location }}</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Description</h2>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ $animal->description }}
                                </p>
                            </div>

                            <div>
                                <h2 class="text-xl font-bold text-[#2F2E41] mb-3">Personnalité</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->species->name }}</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->breed }}</span>
                                    <span class="px-4 py-2 bg-[#FFE3E3] text-[#FF6B6B] rounded-full">{{ $animal->age }} an{{ $animal->age > 1 ? 's' : '' }}</span>
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
                            <h2 class="text-2xl font-bold text-[#2F2E41]">Rencontrer {{ $animal->name }}</h2>
                            <p class="text-gray-600">Remplissez le formulaire ci-dessous pour organiser une rencontre</p>
                        </div>

                        @auth
                            @php
                                $userAppointments = $animal->appointments()->where('user_id', auth()->id())->get();
                                $currentDateTime = \Carbon\Carbon::now();
                                $upcomingAppointments = $userAppointments->filter(function($appointment) use ($currentDateTime) {
                                    return \Carbon\Carbon::parse($appointment->date_time)->gt($currentDateTime);
                                });
                                $pastAppointments = $userAppointments->filter(function($appointment) use ($currentDateTime) {
                                    return \Carbon\Carbon::parse($appointment->date_time)->lt($currentDateTime);
                                });
                            @endphp
                            
                            @if($userAppointments->count() > 0)
                                <div class="mb-6 p-4 bg-[#FFF5F5] rounded-xl">
                                    <h3 class="font-bold text-[#2F2E41] mb-2">Vos rendez-vous avec {{ $animal->name }}</h3>
                                    
                                    @if($upcomingAppointments->count() > 0)
                                        <h4 class="text-sm text-gray-600 mb-1">Prochains rendez-vous</h4>
                                        <div class="space-y-3 mb-4">
                                            @foreach($upcomingAppointments as $appointment)
                                                <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                                                    <div>
                                                        <p class="font-medium text-[#2F2E41]">{{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y à H:i') }}</p>
                                                        <span class="text-xs px-2 py-1 rounded-full 
                                                            @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                                            @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                                            @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                                            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ $appointment->status === 'pending' ? 'En attente' : 
                                                               ($appointment->status === 'confirmed' ? 'Confirmé' : 
                                                               ($appointment->status === 'cancelled' ? 'Annulé' : 
                                                               ($appointment->status === 'completed' ? 'Terminé' : 'Expiré'))) }}
                                                        </span>
                                                    </div>
                                                    @if($appointment->status === 'pending' || $appointment->status === 'confirmed')
                                                        <form method="POST" action="{{ route('appointments.cancel', $appointment) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                                                Annuler
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    @if($pastAppointments->count() > 0)
                                        <h4 class="text-sm text-gray-600 mb-1">Rendez-vous passés</h4>
                                        <div class="space-y-3">
                                            @foreach($pastAppointments->take(3) as $appointment)
                                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                                    <div>
                                                        <p class="font-medium text-gray-500">{{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y à H:i') }}</p>
                                                        <span class="text-xs px-2 py-1 rounded-full 
                                                            @if($appointment->status === 'completed') bg-blue-100 text-blue-800
                                                            @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                                            @elseif($appointment->status === 'expired') bg-gray-100 text-gray-800
                                                            @else bg-gray-100 text-gray-800 @endif">
                                                            {{ $appointment->status === 'completed' ? 'Terminé' : 
                                                               ($appointment->status === 'cancelled' ? 'Annulé' : 
                                                               ($appointment->status === 'expired' ? 'Expiré' : 'Passé')) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @if($pastAppointments->count() > 3)
                                                <p class="text-xs text-gray-500 text-center mt-2">
                                                    + {{ $pastAppointments->count() - 3 }} autres rendez-vous passés
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endauth

                        <form class="space-y-6" action="{{ route('appointments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="animal_id" value="{{ $animal->id }}">

                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Date souhaitée</label>
                                <input type="date" name="date" min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Créneau horaire</label>
                                <select name="time_slot" class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none" required>
                                    <option value="">Sélectionnez un créneau</option>
                                    <option value="10:00 - 11:00">10:00 - 11:00</option>
                                    <option value="11:00 - 12:00">11:00 - 12:00</option>
                                    <option value="14:00 - 15:00">14:00 - 15:00</option>
                                    <option value="15:00 - 16:00">15:00 - 16:00</option>
                                    <option value="16:00 - 17:00">16:00 - 17:00</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[#2F2E41] font-semibold">Message (optionnel)</label>
                                <textarea
                                    name="message"
                                    rows="4"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                                    placeholder="Parlez-nous un peu de vous et de votre motivation..."
                                ></textarea>
                            </div>

                            @guest
                                <div class="p-4 bg-[#FFF5F5] rounded-xl text-center">
                                    <p class="text-gray-600 mb-2">Vous devez être connecté pour demander une rencontre</p>
                                    <a href="{{ route('login') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">Se connecter</a>
                                    <span class="text-gray-600 mx-2">ou</span>
                                    <a href="{{ route('register') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">S'inscrire</a>
                                </div>
                            @else
                                <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                                    Demander une rencontre
                                </button>
                            @endguest
                        </form>

                        @auth
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <div class="text-center space-y-4 mb-6">
                                    <h2 class="text-2xl font-bold text-[#2F2E41]">Adopter {{ $animal->name }}</h2>
                                    <p class="text-gray-600">Remplissez le formulaire ci-dessous pour faire une demande d'adoption</p>
                                </div>

                                @if($animal->status !== 'available')
                                    <div class="p-4 bg-yellow-50 text-yellow-800 rounded-xl text-center mb-6">
                                        <p class="font-medium">{{ $animal->name }} n'est pas disponible à l'adoption pour le moment.</p>
                                        <p class="text-sm">Statut actuel: 
                                            @if($animal->status === 'reserved')
                                                Réservé
                                            @elseif($animal->status === 'adopted')
                                                Déjà adopté
                                            @else
                                                En traitement
                                            @endif
                                        </p>
                                    </div>
                                @else
                                    @php
                                        $existingRequest = \App\Models\AdoptionRequest::where('user_id', auth()->id())
                                            ->where('animal_id', $animal->id)
                                            ->first();
                                    @endphp

                                    @if($existingRequest)
                                        <div class="mb-6 p-4 bg-[#FFF5F5] rounded-xl">
                                            <h3 class="font-bold text-[#2F2E41] mb-2">Votre demande d'adoption</h3>
                                            <div class="p-3 bg-white rounded-lg mb-3">
                                                <div class="flex justify-between items-center mb-2">
                                                    <p class="font-medium text-[#2F2E41]">Demande soumise le {{ \Carbon\Carbon::parse($existingRequest->created_at)->format('d/m/Y') }}</p>
                                                    <span class="text-xs px-2 py-1 rounded-full 
                                                        @if($existingRequest->status === 'approved') bg-green-100 text-green-800
                                                        @elseif($existingRequest->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        {{ $existingRequest->status === 'pending' ? 'En attente' : 
                                                           ($existingRequest->status === 'approved' ? 'Approuvée' : 'Refusée') }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-600 text-sm">{{ $existingRequest->message }}</p>
                                            </div>
                                            @if($existingRequest->status === 'pending')
                                                <form method="POST" action="{{ route('adoption-requests.cancel', $existingRequest->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors">
                                                        Annuler ma demande
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @else
                                        <form class="space-y-6" action="{{ route('adoption-requests.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="animal_id" value="{{ $animal->id }}">

                                            <div class="space-y-2">
                                                <label class="block text-[#2F2E41] font-semibold">Pourquoi souhaitez-vous adopter {{ $animal->name }} ?</label>
                                                <textarea
                                                    name="message"
                                                    rows="5"
                                                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                                                    placeholder="Décrivez votre situation, vos motivations, et pourquoi vous pensez être la famille idéale pour {{ $animal->name }}..."
                                                    required
                                                ></textarea>
                                            </div>

                                            <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                                                Faire une demande d'adoption
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        @else
                            <div class="mt-8 pt-8 border-t border-gray-200">
                                <div class="text-center space-y-4 mb-6">
                                    <h2 class="text-2xl font-bold text-[#2F2E41]">Adopter {{ $animal->name }}</h2>
                                </div>
                                <div class="p-4 bg-[#FFF5F5] rounded-xl text-center">
                                    <p class="text-gray-600 mb-2">Vous devez être connecté pour faire une demande d'adoption</p>
                                    <a href="{{ route('login') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">Se connecter</a>
                                    <span class="text-gray-600 mx-2">ou</span>
                                    <a href="{{ route('register') }}" class="text-[#FF6B6B] hover:text-[#FF8787] font-semibold">S'inscrire</a>
                                </div>
                            </div>
                        @endauth

                        <div class="mt-6 p-4 bg-[#FFF5F5] rounded-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                    📍
                                </div>
                                <div>
                                    <p class="font-semibold text-[#2F2E41]">Refuge PetsCape</p>
                                    <p class="text-sm text-gray-600">{{ $animal->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

