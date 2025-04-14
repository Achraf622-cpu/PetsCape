<?php

namespace App\Http\Controllers;

use App\Models\AnimalReport;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnimalReportController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index(Request $request)
    {
        $query = AnimalReport::with(['species', 'user']);
        
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
        
        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'resolved', 'cancelled'])) {
            $query->where('status', $request->status);
        }
        
        $reports = $query->latest()->paginate(12)->withQueryString();
        $species = Species::all();
        
        return view('reports.index', compact('reports', 'species'));
    }
    
    /**
     * Show the form for creating a new report.
     */
    public function create(Request $request)
{
    $species = Species::all();
    $type = $request->query('type', 'lost');
    $isFound = $type === 'found'; // Add this line
    
    return view('reports.create', compact('species', 'type', 'isFound'));
}
    
    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name' => 'nullable|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'is_found' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $validated['user_id'] = Auth::id();
        $validated['date_reported'] = Carbon::now();
        $validated['status'] = 'pending';
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
            $validated['image'] = $imagePath;
        }
        
        AnimalReport::create($validated);
        
        return redirect()->route('dashboard')
            ->with('success', 'Signalement créé avec succès !');
    }
    
    /**
     * Display the specified report.
     */
    public function show(AnimalReport $report)
    {
        return view('reports.show', compact('report'));
    }
    
    /**
     * Show the form for editing the specified report.
     */
    public function edit(AnimalReport $report)
    {
        $this->authorize('update', $report);
        
        $species = Species::all();
        return view('reports.edit', compact('report', 'species'));
    }
    
    /**
     * Update the specified report in storage.
     */
    public function update(Request $request, AnimalReport $report)
    {
        $this->authorize('update', $report);
        
        $validated = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name' => 'nullable|string|max:255',
            'breed' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
            'status' => 'required|in:pending,resolved,cancelled',
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
        
        return redirect()->route('reports.show', $report)
            ->with('success', 'Signalement mis à jour avec succès !');
    }
    
    /**
     * Remove the specified report from storage.
     */
    public function destroy(AnimalReport $report)
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
     * Display user's own reports.
     */
    public function myReports()
    {
        $reports = AnimalReport::where('user_id', Auth::id())
            ->with('species')
            ->latest()
            ->paginate(10);
            
        return view('reports.my_reports', compact('reports'));
    }
    
    /**
     * Change the status of a report.
     */
    public function changeStatus(Request $request, AnimalReport $report)
    {
        $this->authorize('update', $report);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,resolved,cancelled',
        ]);
        
        $report->update($validated);
        
        return redirect()->back()
            ->with('success', 'Statut du signalement mis à jour !');
    }
} 