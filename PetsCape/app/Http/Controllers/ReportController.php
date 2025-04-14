<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index(Request $request)
    {
        $query = Report::with(['species', 'user']);
        
        // Filter by type (lost or found)
        if ($request->has('type') && in_array($request->type, ['lost', 'found'])) {
            $query->where('is_found', $request->type === 'found');
        }
        
        // Filter by species
        if ($request->has('species_id') && $request->species_id) {
            $query->where('species_id', $request->species_id);
        }
        
        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
        
        $reports = $query->latest()->paginate(12)->withQueryString();
        $species = Species::all();
        
        return view('old-reports.index', compact('reports', 'species'));
    }
    
    /**
     * Show the form for creating a new report.
     */
    public function create(Request $request)
    {
        $species = Species::all();
        $isFound = $request->query('type', 'lost') === 'found';
        
        return view('old-reports.create', compact('species', 'isFound'));
    }
    
    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'age' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:255',
            'is_found' => 'required|boolean',
            'date_of_incident' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['is_resolved'] = false;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
            $validated['image'] = $imagePath;
        }
        
        Report::create($validated);
        
        return redirect()->route('dashboard')
            ->with('success', 'Signalement créé avec succès !');
    }
    
    /**
     * Display the specified report.
     */
    public function show(Report $report)
    {
        return view('old-reports.show', compact('report'));
    }
    
    /**
     * Show the form for editing the specified report.
     */
    public function edit(Report $report)
    {
        $this->authorize('update', $report);
        
        $species = Species::all();
        return view('old-reports.edit', compact('report', 'species'));
    }
    
    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name' => 'required|string|max:255',
            'breed' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'age' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:255',
            'is_resolved' => 'required|boolean',
            'date_of_incident' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($report->image) {
                Storage::disk('public')->delete($report->image);
            }
            
            $imagePath = $request->file('image')->store('reports', 'public');
            $validated['image'] = $imagePath;
        }
        
        $report->update($validated);
        
        return redirect()->route('old-reports.show', $report)
            ->with('success', 'Signalement mis à jour avec succès !');
    }
    
    /**
     * Remove the specified report from storage.
     */
    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);
        
        // Delete the report's image
        if ($report->image) {
            Storage::disk('public')->delete($report->image);
        }
        
        $report->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Signalement supprimé avec succès !');
    }
    
    /**
     * Change the status of a report.
     */
    public function changeStatus(Request $request, Report $report)
    {
        $this->authorize('update', $report);
        
        $validated = $request->validate([
            'is_resolved' => 'required|boolean',
        ]);
        
        $report->update($validated);
        
        return redirect()->back()
            ->with('success', 'Statut du signalement mis à jour !');
    }
} 