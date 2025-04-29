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
    public function index(Request $request)
    {
        $query = Animal::with('species');
        
        // Apply species filter
        if ($request->has('species') && $request->species) {
            $query->where('species_id', $request->species);
        }
        
        // Apply status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('breed', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }
        
        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->oldest();
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
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
        
        $animals = $query->paginate(12)->withQueryString();
        $species = Species::all();
        
        // Check if this is an admin route
        if (request()->routeIs('admin.*')) {
            return view('admin.animals', compact('animals', 'species'));
        }
        
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
        if ($request->has('max_age') && $request->max_age) {
            $query->where('age', '<=', $request->max_age);
        }

        // Apply characteristics filter
        if ($request->has('characteristics') && is_array($request->characteristics)) {
            // This is a simplified approach, ideally characteristics would be in their own table
            // with a many-to-many relationship to animals
            foreach ($request->characteristics as $characteristic) {
                $query->where('description', 'like', '%' . $characteristic . '%');
            }
        }

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

        $animals = $query->paginate(12)->withQueryString();
        $species = Species::all();
        $adoptedCount = Animal::where('status', 'adopted')->count();

        return view('animal.pet_adoption_page', compact('animals', 'species', 'adoptedCount'));
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
            // Create the directory if it doesn't exist
            $directory = 'public/animals';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            
            // Store the image with a unique name
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('animals', $filename, 'public');
            $validated['image'] = $path;
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
        $animal->load('appointments', 'species');
        return view('animal.pet_meeting_page', compact('animal'));
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
            if ($animal->image && Storage::disk('public')->exists($animal->image)) {
                Storage::disk('public')->delete($animal->image);
            }

            // Create the directory if it doesn't exist
            $directory = 'public/animals';
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            
            // Store the image with a unique name
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('animals', $filename, 'public');
            $validated['image'] = $path;
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
