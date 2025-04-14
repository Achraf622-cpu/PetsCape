<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Appointment;
use App\Models\User;
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
        $todayAppointments = Appointment::whereDate('date', Carbon::today())->count();
        
        // Count active reports (placeholder - you might need to create a Report model)
        $activeReports = 0;
        
        // Get today's appointments for display
        $appointments = Appointment::with(['animal', 'user'])
            ->whereDate('date', Carbon::today())
            ->orderBy('date')
            ->orderBy('time_slot')
            ->take(5)
            ->get();
            
        return view('admin.admin_dashboard_overview', compact(
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
        return app(AnimalController::class)->index($request);
    }
    
    /**
     * Show the admin appointments page.
     */
    public function appointments()
    {
        $appointments = Appointment::with(['animal', 'user'])
            ->orderBy('date', 'desc')
            ->orderBy('time_slot')
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
        // Placeholder for reports - you might need to create a Report model
        return view('admin.reports');
    }
} 