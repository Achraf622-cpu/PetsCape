@extends('admin.layouts.master')

@section('title', 'Gestion des Dons')
@section('page-title', 'Dons')
@section('page-subtitle', 'Récapitulatif de tous les dons')

@section('content')
    <!-- Donations Summary -->
    <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow flex items-center gap-4">
            <div class="p-3 rounded-full bg-green-100 text-green-800">
                <span class="text-2xl">💰</span>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Total des dons</p>
                <p class="text-2xl font-bold">{{ number_format($totalAmount, 2, ',', ' ') }} €</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex items-center gap-4">
            <div class="p-3 rounded-full bg-blue-100 text-blue-800">
                <span class="text-2xl">👥</span>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Nombre de donateurs</p>
                <p class="text-2xl font-bold">{{ $uniqueDonors }}</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex items-center gap-4">
            <div class="p-3 rounded-full bg-purple-100 text-purple-800">
                <span class="text-2xl">🎁</span>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Don moyen</p>
                <p class="text-2xl font-bold">{{ number_format($averageDonation, 2, ',', ' ') }} €</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow flex items-center gap-4">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                <span class="text-2xl">🗓️</span>
            </div>
            <div>
                <p class="text-gray-500 text-sm">Dernier don reçu</p>
                <p class="text-2xl font-bold">{{ $lastDonation ? $lastDonation->created_at->format('d/m/Y') : 'Aucun' }}</p>
            </div>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Historique des dons</h2>
        
        @if($donations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Donateur</th>
                            <th class="pb-3">Montant</th>
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Référence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $donation->user->name ?? 'Utilisateur inconnu' }}</td>
                                <td class="py-3">{{ number_format($donation->amount, 2, ',', ' ') }} €</td>
                                <td class="py-3">{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($donation->status == 'completed') bg-green-100 text-green-800
                                        @elseif($donation->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($donation->status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-xs text-gray-500">{{ $donation->stripe_session_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $donations->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun don enregistré pour le moment.</p>
        @endif
    </div>
@endsection 