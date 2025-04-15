@extends('layouts.index')

@section('title', 'Réinitialiser mon mot de passe')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-28">
    <div class="bg-white rounded-2xl p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-[#2F2E41] mb-6">Réinitialiser mon mot de passe</h1>
        
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-[#2F2E41] font-semibold">Adresse email</label>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Envoyer le lien de réinitialisation
            </button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-[#FF6B6B] hover:text-[#FF8787]">
                    Retour à la connexion
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 