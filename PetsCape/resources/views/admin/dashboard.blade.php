@extends('admin.layouts.master')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')
@section('page-subtitle', 'Vue d\'ensemble de PetsCape')

@section('content')
    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-white p-4 md:p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-xs md:text-sm mb-1">Animaux</h3>
            <p class="text-xl md:text-3xl font-bold text-gray-800">{{ $totalAnimals }}</p>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-xs md:text-sm mb-1">Adoptions en cours</h3>
            <p class="text-xl md:text-3xl font-bold text-gray-800">{{ $ongoingAdoptions }}</p>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-xs md:text-sm mb-1">Rendez-vous aujourd'hui</h3>
            <p class="text-xl md:text-3xl font-bold text-gray-800">{{ $todayAppointments }}</p>
        </div>
        <div class="bg-white p-4 md:p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-xs md:text-sm mb-1">Signalements actifs</h3>
            <p class="text-xl md:text-3xl font-bold text-gray-800">{{ $activeReports }}</p>
        </div>
    </div>

    <!-- Today's Appointments -->
    <div class="bg-white p-4 md:p-6 rounded-lg shadow">
        <h3 class="text-base md:text-lg font-bold text-gray-800 mb-4">Rendez-vous</h3>
        
        @if($appointments->count() > 0)
            <div class="overflow-x-auto -mx-4 md:mx-0">
                <table class="w-full table-auto min-w-full">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3 px-4 md:px-3">Date & Heure</th>
                            <th class="pb-3 px-4 md:px-3">Client</th>
                            <th class="pb-3 px-4 md:px-3">Animal</th>
                            <th class="pb-3 px-4 md:px-3">Statut</th>
                            <th class="pb-3 px-4 md:px-3">État</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // For testing/demonstration purposes - should be removed in production and use the default now()
                            $currentDateTime = \Carbon\Carbon::createFromFormat('d/m/Y H:i', '30/04/2025 15:11');
                        @endphp
                        
                        @foreach($appointments as $appointment)
                            @php
                                $appointmentTime = \Carbon\Carbon::parse($appointment->date_time);
                                $isPassed = $appointmentTime->lt($currentDateTime);
                            @endphp
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $appointmentTime->format('d/m/Y H:i') }}</td>
                                <td class="py-3">{{ $appointment->user->firstname }} {{ $appointment->user->lastname }}</td>
                                <td class="py-3">{{ $appointment->animal->name }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    @if($isPassed)
                                        <span class="px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                            Déjà passé
                                        </span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-800">
                                            À venir
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Aucun rendez-vous prévu aujourd'hui.</p>
        @endif
    </div>
@endsection
