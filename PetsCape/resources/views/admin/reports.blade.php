@extends('admin.layouts.master')

@section('title', 'Gestion des Signalements')
@section('page-title', 'Signalements')
@section('page-subtitle', 'Gestion des animaux signalés perdus ou trouvés')

@section('content')
    <!-- Reports Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        @if($reports->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Date</th>
                            <th class="pb-3">Type</th>
                            <th class="pb-3">Lieu</th>
                            <th class="pb-3">Signalé par</th>
                            <th class="pb-3">Statut</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $report->created_at->format('d/m/Y') }}</td>
                                <td class="py-3">{{ $report->species->name ?? 'Non défini' }}</td>
                                <td class="py-3">{{ $report->location }}</td>
                                <td class="py-3">{{ $report->user->firstname ?? 'N/A' }} {{ $report->user->lastname ?? '' }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($report->is_found) bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ $report->is_found ? 'Trouvé' : 'Perdu' }}
                                    </span>
                                </td>
                                <td class="py-3 flex gap-2">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                                        <span class="text-sm">👁️</span> Voir
                                    </a>
                                    <form method="POST" action="#">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="is_found" value="{{ !$report->is_found }}">
                                        <button type="submit" class="text-green-500 hover:text-green-700 flex items-center gap-1">
                                            <span class="text-sm">{{ $report->is_found ? '❓' : '✅' }}</span>
                                            {{ $report->is_found ? 'Marquer comme perdu' : 'Marquer comme trouvé' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun signalement enregistré.</p>
        @endif
    </div>
@endsection
