@extends('admin.layouts.master')

@section('title', 'Gestion des Animaux')
@section('page-title', 'Animaux')
@section('page-subtitle', 'Gestion de tous les animaux')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div></div>
        <a href="{{ route('animals.create') }}" class="px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors flex items-center gap-2">
            <span class="text-xl">➕</span>
            <span>Ajouter un animal</span>
        </a>
    </div>

    <!-- Animals Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        @if($animals->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Nom</th>
                            <th class="pb-3">Espèce</th>
                            <th class="pb-3">Âge</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($animals as $animal)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $animal->name }}</td>
                                <td class="py-3">{{ $animal->species->name ?? 'Non défini' }}</td>
                                <td class="py-3">{{ $animal->age }} ans</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($animal->status == 'available') bg-green-100 text-green-800
                                        @elseif($animal->status == 'reserved') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($animal->status) }}
                                    </span>
                                </td>
                                <td class="py-3 flex gap-2">
                                    <a href="{{ route('animals.show', $animal) }}" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                                        <span class="text-sm">👁️</span> Voir
                                    </a>
                                    <a href="{{ route('animals.edit', $animal) }}" class="text-green-500 hover:text-green-700 flex items-center gap-1">
                                        <span class="text-sm">✏️</span> Modifier
                                    </a>
                                    <form action="{{ route('animals.destroy', $animal) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet animal?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 flex items-center gap-1">
                                            <span class="text-sm">🗑️</span> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $animals->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun animal enregistré.</p>
        @endif
    </div>
@endsection