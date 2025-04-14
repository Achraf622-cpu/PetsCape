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
