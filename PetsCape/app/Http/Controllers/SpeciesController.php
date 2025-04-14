<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $species = Species::all();
        return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('species.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Species::create($validated);

        return redirect()->route('species.index')
            ->with('success', 'Espèce créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Species $species)
    {
        return view('species.show', compact('species'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Species $species)
    {
        return view('species.edit', compact('species'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $species->update($validated);

        return redirect()->route('species.index')
            ->with('success', 'Espèce mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Species $species)
    {
        // Check if species has animals
        if ($species->animals()->count() > 0) {
            return redirect()->route('species.index')
                ->with('error', 'Impossible de supprimer cette espèce car elle est associée à des animaux.');
        }

        $species->delete();

        return redirect()->route('species.index')
            ->with('success', 'Espèce supprimée avec succès.');
    }
}
