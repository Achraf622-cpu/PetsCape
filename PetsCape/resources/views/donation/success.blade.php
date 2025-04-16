@extends('layouts.index')

@section('title', 'Don effectué avec succès')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="rounded-full bg-green-100 p-4 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
            <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Merci pour votre don !</h1>
        
        <p class="text-xl text-gray-600 mb-6">
            Votre don de <span class="font-bold">{{ $amount }}€</span> a bien été reçu.
        </p>
        
        <p class="text-gray-600 mb-8">
            Grâce à votre générosité, nous pourrons continuer à prendre soin des animaux abandonnés 
            et à leur offrir une seconde chance. Votre contribution fait une réelle différence.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-md hover:bg-[#FF8787] focus:outline-none focus:ring-2 focus:ring-[#FF6B6B] focus:ring-opacity-50 transition-colors">
                Retour à l'accueil
            </a>
            <a href="{{ route('donation.form') }}" class="px-6 py-3 border border-[#FF6B6B] text-[#FF6B6B] rounded-md hover:bg-[#FFF0F0] focus:outline-none focus:ring-2 focus:ring-[#FF6B6B] focus:ring-opacity-50 transition-colors">
                Faire un autre don
            </a>
        </div>
    </div>
</div>
@endsection 