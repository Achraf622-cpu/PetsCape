<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Report;
use App\Models\AnimalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Count total animals
        $totalAnimals = Animal::count();
        
        // Count ongoing adoptions (animals with reserved status)
        $ongoingAdoptions = Animal::where('status', 'reserved')->count();
        
        // Count today's appointments
        $todayAppointments = Appointment::whereDate('date_time', Carbon::today())->count();
        
        // Count active reports 
        $activeReports = AnimalReport::where('is_found', false)->count();
        
        // Get today's appointments for display
        $appointments = Appointment::with(['animal', 'user'])
            ->whereDate('date_time', Carbon::today())
            ->orderBy('date_time')
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact(
            'totalAnimals', 
            'ongoingAdoptions', 
            'todayAppointments', 
            'activeReports',
            'appointments'
        ));
    }
    
    /**
     * Show the admin animals page.
     */
    public function animals(Request $request)
    {
        $animals = Animal::with('species')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.animals', compact('animals'));
    }
    
    /**
     * Show the admin appointments page.
     */
    public function appointments()
    {
        $appointments = Appointment::with(['animal', 'user'])
            ->orderBy('date_time', 'desc')
            ->paginate(15);
            
        return view('admin.appointments', compact('appointments'));
    }
    
    /**
     * Show the admin adoptions page.
     */
    public function adoptions()
    {
        $adoptions = Animal::with('species')
            ->where('status', 'adopted')
            ->orderBy('updated_at', 'desc')
            ->paginate(15);
            
        return view('admin.adoptions', compact('adoptions'));
    }
    
    /**
     * Show the admin users page.
     */
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.users', compact('users'));
    }
    
    /**
     * Show the admin reports page.
     */
    public function reports()
    {
        $reports = AnimalReport::with(['species', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.reports', compact('reports'));
    }
}
