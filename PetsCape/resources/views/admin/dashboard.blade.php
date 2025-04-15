@extends('admin.layouts.master')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')
@section('page-subtitle', 'Vue d\'ensemble de PetsCape')

@section('content')
    <!-- Dashboard Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm mb-1">Animaux</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $totalAnimals }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm mb-1">Adoptions en cours</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $ongoingAdoptions }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm mb-1">Rendez-vous aujourd'hui</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $todayAppointments }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm mb-1">Signalements actifs</h3>
            <p class="text-3xl font-bold text-gray-800">{{ $activeReports }}</p>
        </div>
    </div>

    <!-- Today's Appointments -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Rendez-vous d'aujourd'hui</h3>
        
        @if($appointments->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Heure</th>
                            <th class="pb-3">Client</th>
                            <th class="pb-3">Animal</th>
                            <th class="pb-3">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $appointment->time_slot }}</td>
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
