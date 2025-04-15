@extends('admin.layouts.master')

@section('title', 'Gestion des Utilisateurs')
@section('page-title', 'Utilisateurs')
@section('page-subtitle', 'Gestion de tous les utilisateurs')

@section('content')
    <!-- Users Table -->
    <div class="bg-white p-6 rounded-lg shadow">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-3">Nom</th>
                            <th class="pb-3">Email</th>
                            <th class="pb-3">Téléphone</th>
                            <th class="pb-3">Rôle</th>
                            <th class="pb-3">Date d'inscription</th>
                            <th class="pb-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3">{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">{{ $user->phone ?? 'Non renseigné' }}</td>
                                <td class="py-3">
                                    <span class="px-2 py-1 rounded-full text-xs 
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                                <td class="py-3 flex gap-2">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 flex items-center gap-1">
                                        <span class="text-sm">👁️</span> Voir
                                    </a>
                                    <a href="#" class="text-green-500 hover:text-green-700 flex items-center gap-1">
                                        <span class="text-sm">✏️</span> Modifier
                                    </a>
                                    @if($user->role !== 'admin')
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="role" value="admin">
                                            <button type="submit" class="text-purple-500 hover:text-purple-700 flex items-center gap-1">
                                                <span class="text-sm">👑</span> Promouvoir admin
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <p class="text-gray-500">Aucun utilisateur enregistré.</p>
        @endif
    </div>
@endsection
