@extends('admin.layouts.master')

@section('title', 'Gestion des Rendez-vous')
@section('page-title', 'Rendez-vous')
@section('page-subtitle', 'Gestion de tous les rendez-vous')

@section('content')
    <!-- Appointments Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        @if($appointments->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Client</th>
                            <th class="pb-3">Animal</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ \Carbon\Carbon::parse($appointment->date_time)->format('d/m/Y H:i') }}</td>
                                <td class="py-3">{{ $appointment->user->firstname ?? 'N/A' }} {{ $appointment->user->lastname ?? '' }}</td>
                                <td class="py-3">{{ $appointment->animal->name ?? 'N/A' }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td class="py-3 flex gap-2">
                                    <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="text-green-500 hover:text-green-700 flex items-center gap-1">
                                            <span class="text-sm">✅</span> Confirmer
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('appointments.update-status', $appointment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="text-red-500 hover:text-red-700 flex items-center gap-1">
                                            <span class="text-sm">❌</span> Annuler
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun rendez-vous enregistré.</p>
        @endif
    </div>
@endsection
