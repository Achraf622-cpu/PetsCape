@extends('layouts.index')

@section('title', 'Don annulé')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <div class="rounded-full bg-red-100 p-4 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
            <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Don annulé</h1>
        
        <p class="text-gray-600 mb-8">
            Votre don a été annulé. Aucun montant n'a été prélevé sur votre compte.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}" class="px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 transition-colors">
                Retour à l'accueil
            </a>
            <a href="{{ route('donation.form') }}" class="px-6 py-3 bg-[#FF6B6B] text-white rounded-md hover:bg-[#FF8787] focus:outline-none focus:ring-2 focus:ring-[#FF6B6B] focus:ring-opacity-50 transition-colors">
                Réessayer
            </a>
        </div>
    </div>
</div>
@endsection 