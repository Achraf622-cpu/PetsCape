@extends('admin.layouts.master')

@section('title', 'Gestion des Adoptions')
@section('page-title', 'Adoptions')
@section('page-subtitle', 'Suivi des animaux adoptés')

@section('content')
    <!-- Adoptions Table -->
    <div class="bg-white p-6 rounded-lg shadow">
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
