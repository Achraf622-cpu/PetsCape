<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured animals.
     */
    public function index()
    {
        // Get the latest 3 available animals
        $featuredAnimals = Animal::with('species')
            ->where('status', 'available')
            ->latest()
            ->take(3)
            ->get();
            
        return view('welcome', compact('featuredAnimals'));
    }
} 