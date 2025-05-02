@extends('admin.layouts.master')

@section('title', 'Gestion des Adoptions')
@section('page-title', 'Adoptions')
@section('page-subtitle', 'Gérer les demandes d\'adoption')

@section('content')
    <!-- Adoption Requests Table -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Demandes d'adoption en attente</h3>
        
        @php
            $pendingRequests = \App\Models\AdoptionRequest::where('status', 'pending')
                ->with(['animal', 'user'])
                ->orderBy('created_at', 'desc')
                ->get();
        @endphp
        
        @if($pendingRequests->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Animal</th>
                            <th class="pb-3">Demandeur</th>
                            <th class="pb-3">Date de demande</th>
                            <th class="pb-3">Message</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRequests as $request)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $request->animal->image ? asset('storage/'.$request->animal->image) : asset('images/default-animal.jpg') }}" 
                                             alt="{{ $request->animal->name }}" 
                                             class="w-10 h-10 rounded-full object-cover">
                                        <div>
                                            <p class="font-semibold">{{ $request->animal->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $request->animal->species->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <p>{{ $request->user->firstname }} {{ $request->user->lastname }}</p>
                                    <p class="text-xs text-gray-500">{{ $request->user->email }}</p>
                                </td>
                                <td class="py-3">{{ \Carbon\Carbon::parse($request->created_at)->format('d/m/Y') }}</td>
                                <td class="py-3 max-w-md">
                                    <p class="truncate">{{ $request->message }}</p>
                                    <button 
                                        class="text-xs text-blue-500 hover:text-blue-700" 
                                        onclick="showMessage('{{ addslashes($request->message) }}', '{{ $request->user->firstname }} {{ $request->user->lastname }}')">
                                        Voir le message complet
                                    </button>
                                </td>
                                <td class="py-3">
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('adoption-requests.update-status', $request->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs hover:bg-green-200">
                                                Approuver
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('adoption-requests.update-status', $request->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs hover:bg-red-200">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">Aucune demande d'adoption en attente.</p>
        @endif
    </div>

    <!-- Adoptions History Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Historique des adoptions</h3>
        
        @if($adoptions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Animal</th>
                            <th class="pb-3">Espèce</th>
                            <th class="pb-3">Âge</th>
                            <th class="pb-3">Date d'adoption</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adoptions as $animal)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $animal->name }}</td>
                                <td class="py-3">{{ $animal->species->name ?? 'Non défini' }}</td>
                                <td class="py-3">{{ $animal->age }} ans</td>
                                <td class="py-3">{{ $animal->updated_at->format('d/m/Y') }}</td>
                                <td class="py-3 flex gap-2">
                                    <a href="{{ route('animals.show', $animal) }}" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                                        <span class="text-sm">👁️</span> Voir
                                    </a>
                                    <a href="#" class="text-green-500 hover:text-green-700 flex items-center gap-1">
                                        <span class="text-sm">📄</span> Certificat
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $adoptions->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucune adoption enregistrée.</p>
        @endif
    </div>
@endsection
