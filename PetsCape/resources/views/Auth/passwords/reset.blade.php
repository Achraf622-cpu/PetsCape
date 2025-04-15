@extends('layouts.index')

@section('title', 'Réinitialiser mon mot de passe')

@section('content')
<div class="max-w-2xl mx-auto px-6 py-28">
    <div class="bg-white rounded-2xl p-8 shadow-sm">
        <h1 class="text-3xl font-bold text-[#2F2E41] mb-6">Réinitialiser mon mot de passe</h1>
        
        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="space-y-2">
                <label for="email" class="block text-[#2F2E41] font-semibold">Adresse email</label>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    value="{{ $email ?? old('email') }}" 
                    required 
                    autofocus
                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-[#2F2E41] font-semibold">Nouveau mot de passe</label>
                <input 
                    id="password"
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="password-confirm" class="block text-[#2F2E41] font-semibold">Confirmer le mot de passe</label>
                <input 
                    id="password-confirm"
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-[#FFE3E3] focus:border-[#FF6B6B] focus:outline-none"
                >
            </div>

            <button type="submit" class="w-full py-4 bg-[#FF6B6B] text-white rounded-xl hover:bg-[#FF8787] transition-colors">
                Réinitialiser le mot de passe
            </button>
        </form>
    </div>
</div>
@endsection 