@extends('layouts.index')

@section('title', 'Faire un don')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Faire un don à PetsCape</h1>
        
        <p class="text-gray-600 mb-8">
            Votre soutien financier nous aide à prendre soin des animaux abandonnés et à leur trouver 
            de nouvelles familles aimantes. Chaque don, petit ou grand, fait une grande différence dans la vie de nos pensionnaires.
        </p>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('donation.process') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Montant du don (€)</label>
                <div class="flex">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">€</span>
                        </div>
                        <input type="number" id="amount" name="amount" min="1" step="1" 
                               class="pl-8 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#FF6B6B] focus:ring focus:ring-[#FF6B6B] focus:ring-opacity-50"
                               value="{{ old('amount', 20) }}" required>
                    </div>
                </div>
                @error('amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="w-full px-6 py-3 bg-[#FF6B6B] text-white rounded-md hover:bg-[#FF8787] focus:outline-none focus:ring-2 focus:ring-[#FF6B6B] focus:ring-opacity-50 transition-colors">
                    Procéder au don
                </button>
            </div>
        </form>

        <div class="mt-8 px-6 py-4 bg-blue-50 rounded-md">
            <h2 class="text-lg font-semibold text-blue-800 mb-2">Pourquoi faire un don ?</h2>
            <ul class="list-disc pl-5 space-y-2 text-blue-700">
                <li>Pour nourrir et soigner les animaux abandonnés</li>
                <li>Pour financer les traitements médicaux et les vaccinations</li>
                <li>Pour améliorer nos infrastructures d'accueil</li>
                <li>Pour soutenir nos programmes d'éducation et de sensibilisation</li>
            </ul>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-500">
                Paiement sécurisé par 
                <img src="https://www.vectorlogo.zone/logos/stripe/stripe-wordmark.svg" alt="Stripe" class="inline-block h-6 mx-1">
            </p>
        </div>
    </div>
</div>
@endsection 