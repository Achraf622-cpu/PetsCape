@extends('admin.layouts.master')

@section('title', 'Modifier un Animal')
@section('page-title', 'Modifier un animal')
@section('page-subtitle', 'Mettre à jour les informations de ' . $animal->name)

@section('content')
    <div class="bg-white rounded-2xl shadow-sm p-6 max-w-4xl mx-auto">
        <form action="{{ route('animals.update', $animal) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Erreurs de validation -->
            @if ($errors->any())
                <div class="bg-red-100 p-4 rounded-lg mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Informations de base -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $animal->name) }}"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        required
                    >
                </div>

                <div>
                    <label for="species_id" class="block text-sm font-medium text-gray-700 mb-2">Espèce</label>
                    <select
                        id="species_id"
                        name="species_id"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        required
                    >
                        <option value="">Sélectionner une espèce</option>
                        @foreach($species as $specie)
                            <option value="{{ $specie->id }}" {{ old('species_id', $animal->species_id) == $specie->id ? 'selected' : '' }}>
                                {{ $specie->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">Race</label>
                    <input
                        type="text"
                        id="breed"
                        name="breed"
                        value="{{ old('breed', $animal->breed) }}"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        required
                    >
                </div>

                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700 mb-2">Âge (en années)</label>
                    <input
                        type="number"
                        id="age"
                        name="age"
                        value="{{ old('age', $animal->age) }}"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        min="0"
                        required
                    >
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                    <select
                        id="status"
                        name="status"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        required
                    >
                        <option value="available" {{ old('status', $animal->status) == 'available' ? 'selected' : '' }}>Disponible</option>
                        <option value="reserved" {{ old('status', $animal->status) == 'reserved' ? 'selected' : '' }}>Réservé</option>
                        <option value="adopted" {{ old('status', $animal->status) == 'adopted' ? 'selected' : '' }}>Adopté</option>
                        <option value="under_treatment" {{ old('status', $animal->status) == 'under_treatment' ? 'selected' : '' }}>En traitement</option>
                    </select>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Emplacement</label>
                    <input
                        type="text"
                        id="location"
                        name="location"
                        value="{{ old('location', $animal->location) }}"
                        class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                        placeholder="Ex: Box 3, Refuge Paris"
                        required
                    >
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                    required
                >{{ old('description', $animal->description) }}</textarea>
            </div>

            <!-- Image actuelle -->
            @if($animal->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                    <div class="w-48 h-48 rounded-xl overflow-hidden">
                        <img src="{{ asset('storage/' . $animal->image) }}" alt="{{ $animal->name }}" class="w-full h-full object-cover">
                    </div>
                </div>
            @endif

            <!-- Nouvelle image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $animal->image ? 'Changer l\'image (optionnel)' : 'Image' }}
                </label>
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="w-full px-4 py-2 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                    accept="image/*"
                    {{ $animal->image ? '' : 'required' }}
                >
                <p class="text-sm text-gray-500 mt-1">Format accepté: JPEG, PNG, JPG, GIF. Taille max: 2MB</p>
            </div>

            <!-- Boutons -->
            <div class="flex gap-4 pt-4">
                <button
                    type="submit"
                    class="flex-1 px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]"
                >
                    Mettre à jour
                </button>

                <a
                    href="{{ route('animals.index') }}"
                    class="flex-1 px-6 py-3 border-2 border-[#FF6B6B] text-[#FF6B6B] text-center rounded-xl hover:bg-[#FFE3E3]"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
@endsection
