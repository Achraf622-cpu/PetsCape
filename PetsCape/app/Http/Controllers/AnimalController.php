<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimalController extends Controller
{
    /**
     * Display a listing of the animals.
     */
    public function index()
    {
        $animals = Animal::with('species')->latest()->paginate(12);

        return view('animal.index', compact('animals'));
    }

    /**
     * Display the animal adoption page with filters.
     */
    public function adoptionPage(Request $request)
    {
        $query = Animal::with('species')->where('status', 'available');

        // Apply species filter
        if ($request->has('species') && $request->species) {
            $query->where('species_id', $request->species);
        }

        // Apply age filter
        if ($request->has('age') && $request->age) {
            $query->where('age', '<=', $request->age);
        }

        // Apply characteristics filter (à adapter selon votre modèle de données)
        // Ce code est un exemple, vous devrez l'adapter à votre structure

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('breed', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'age_asc':
                    $query->orderBy('age', 'asc');
                    break;
                case 'age_desc':
                    $query->orderBy('age', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $animals = $query->paginate(12);
        $species = Species::all();

        return view('animal.adoption', compact('animals', 'species'));
    }

    /**
     * Show the form for creating a new animal.
     */
    public function create()
    {
        $species = Species::all();
        return view('animal.create', compact('species'));
    }

    /**
     * Store a newly created animal in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|in:available,reserved,adopted,under_treatment',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('animals', 'public');
            $validated['image'] = $imagePath;
        }

        Animal::create($validated);

        return redirect()->route('animals.index')
            ->with('success', 'Animal créé avec succès.');
    }

    /**
     * Display the specified animal.
     */
    public function show(Animal $animal)
    {
        return view('animal.show', compact('animal'));
    }

    /**
     * Display the animal meeting page.
     */
    public function meetingPage(Animal $animal)
    {
        return view('animal.meeting', compact('animal'));
    }

    /**
     * Show the form for editing the specified animal.
     */
    public function edit(Animal $animal)
    {
        $species = Species::all();
        return view('animal.edit', compact('animal', 'species'));
    }

    /**
     * Update the specified animal in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species_id' => 'required|exists:species,id',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'description' => 'required|string',
            'status' => 'required|in:available,reserved,adopted,under_treatment',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($animal->image) {
                Storage::disk('public')->delete($animal->image);
            }

            $imagePath = $request->file('image')->store('animals', 'public');
            $validated['image'] = $imagePath;
        }

        $animal->update($validated);

        return redirect()->route('animals.index')
            ->with('success', 'Animal mis à jour avec succès.');
    }

    /**
     * Remove the specified animal from storage.
     */
    public function destroy(Animal $animal)
    {
        // Delete the animal's image
        if ($animal->image) {
            Storage::disk('public')->delete($animal->image);
        }

        $animal->delete();

        return redirect()->route('animals.index')
            ->with('success', 'Animal supprimé avec succès.');
    }
}
