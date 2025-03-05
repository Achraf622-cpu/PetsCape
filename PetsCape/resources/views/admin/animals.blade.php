@extends('admin.layouts.master')

@section('title', 'Gestion des Animaux')
@section('page-title', 'Gestion des Animaux')
@section('page-subtitle', 'Gérez les animaux du refuge')

@section('content')
    <!-- Actions principales -->
    <div class="flex flex-wrap gap-4 mb-8">
        <button class="px-6 py-3 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] flex items-center gap-2">
            <span>➕</span> Ajouter un animal
        </button>
        <button class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>📥</span> Exporter
        </button>
        <button class="px-6 py-3 bg-white text-[#2F2E41] rounded-xl hover:bg-gray-50 flex items-center gap-2 border">
            <span>🖨️</span> Imprimer
        </button>
    </div>

    <!-- Filtres et recherche -->
    <div class="bg-white p-6 rounded-2xl shadow-sm mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <div class="lg:col-span-2">
                <div class="relative">
                    <input
                        type="text"
                        placeholder="Rechercher un animal..."
                        class="w-full px-4 py-3 pl-12 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                    >
                    <span class="absolute left-4 top-1/2 transform -translate-y-1/2">🔍</span>
                </div>
            </div>

            <div>
                <select class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                    <option value="">Type d'animal</option>
                    <option value="chien">Chien</option>
                    <option value="chat">Chat</option>
                    <option value="lapin">Lapin</option>
                    <option value="oiseau">Oiseau</option>
                </select>
            </div>

            <div>
                <select class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                    <option value="">Statut</option>
                    <option value="disponible">Disponible</option>
                    <option value="reserve">Réservé</option>
                    <option value="adopte">Adopté</option>
                    <option value="quarantaine">En quarantaine</option>
                </select>
            </div>

            <div>
                <select class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none appearance-none bg-white">
                    <option value="">Trier par</option>
                    <option value="recent">Plus récent</option>
                    <option value="ancien">Plus ancien</option>
                    <option value="nom">Nom (A-Z)</option>
                    <option value="age">Âge</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Liste des animaux -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Carte Animal 1 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="relative">
                <img src="/images/dog1.jpg" alt="Max" class="w-full h-48 object-cover">
                <span class="absolute top-4 right-4 px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                    Disponible
                </span>
            </div>

            <div class="p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-bold text-lg text-[#2F2E41]">Max</h3>
                        <p class="text-gray-600">Berger Allemand</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">⋮</button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600">Âge</p>
                        <p class="font-semibold text-[#2F2E41]">2 ans</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Sexe</p>
                        <p class="font-semibold text-[#2F2E41]">Mâle</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Poids</p>
                        <p class="font-semibold text-[#2F2E41]">28 kg</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Puce</p>
                        <p class="font-semibold text-[#2F2E41]">#12345</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                        Modifier
                    </button>
                    <button class="px-4 py-2 border border-[#FFE3E3] rounded-xl hover:bg-[#FFE3E3]">
                        👁️
                    </button>
                </div>
            </div>
        </div>

        <!-- Carte Animal 2 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="relative">
                <img src="/images/cat1.jpg" alt="Luna" class="w-full h-48 object-cover">
                <span class="absolute top-4 right-4 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                    Réservé
                </span>
            </div>

            <div class="p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-bold text-lg text-[#2F2E41]">Luna</h3>
                        <p class="text-gray-600">Chat Siamois</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">⋮</button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600">Âge</p>
                        <p class="font-semibold text-[#2F2E41]">1 an</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Sexe</p>
                        <p class="font-semibold text-[#2F2E41]">Femelle</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Poids</p>
                        <p class="font-semibold text-[#2F2E41]">3.5 kg</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Puce</p>
                        <p class="font-semibold text-[#2F2E41]">#67890</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                        Modifier
                    </button>
                    <button class="px-4 py-2 border border-[#FFE3E3] rounded-xl hover:bg-[#FFE3E3]">
                        👁️
                    </button>
                </div>
            </div>
        </div>

        <!-- Carte Animal 3 -->
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="relative">
                <img src="/images/rabbit1.jpg" alt="Carot" class="w-full h-48 object-cover">
                <span class="absolute top-4 right-4 px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                    Quarantaine
                </span>
            </div>

            <div class="p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-bold text-lg text-[#2F2E41]">Carot</h3>
                        <p class="text-gray-600">Lapin Nain</p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">⋮</button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-600">Âge</p>
                        <p class="font-semibold text-[#2F2E41]">6 mois</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Sexe</p>
                        <p class="font-semibold text-[#2F2E41]">Mâle</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Poids</p>
                        <p class="font-semibold text-[#2F2E41]">1.2 kg</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Puce</p>
                        <p class="font-semibold text-[#2F2E41]">#54321</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button class="flex-1 px-4 py-2 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787]">
                        Modifier
                    </button>
                    <button class="px-4 py-2 border border-[#FFE3E3] rounded-xl hover:bg-[#FFE3E3]">
                        👁️
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <nav class="flex gap-2">
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50 text-gray-500">Précédent</button>
            <button class="px-4 py-2 bg-[#FF6B6B] text-white rounded-xl">1</button>
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50">2</button>
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50">3</button>
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50">...</button>
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50">8</button>
            <button class="px-4 py-2 border rounded-xl hover:bg-gray-50 text-gray-500">Suivant</button>
        </nav>
    </div>
@endsection

@push('scripts')
    <script>
        // Script pour le menu contextuel et les actions
        function openAddAnimalModal() {
            // Code pour ouvrir la modale d'ajout d'animal
        }
    </script>
@endpush
