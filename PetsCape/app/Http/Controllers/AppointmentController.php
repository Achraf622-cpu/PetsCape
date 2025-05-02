<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // Automatically update past appointments
        $this->updatePastAppointments();
    }
    
    /**
     * Update the status of past appointments.
     */
    private function updatePastAppointments()
    {
        // Find confirmed appointments that are in the past and mark them as completed
        Appointment::where('status', 'confirmed')
            ->where('date_time', '<', Carbon::now())
            ->update(['status' => 'completed']);
            
        // Find pending appointments that are in the past and mark them as expired
        Appointment::where('status', 'pending')
            ->where('date_time', '<', Carbon::now())
            ->update(['status' => 'expired']);
    }

    /**
     * Créer un nouveau rendez-vous
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required|string',
            'message' => 'nullable|string',
        ]);

        // Créer le rendez-vous
        $appointment = new Appointment();
        $appointment->user_id = Auth::id();
        $appointment->animal_id = $validated['animal_id'];
        
        // Combine date and time_slot into date_time
        $dateTime = $validated['date'] . ' ' . explode(' - ', $validated['time_slot'])[0];
        $appointment->date_time = $dateTime;
        
        $appointment->status = 'pending';
        $appointment->notes = $validated['message'] ?? null;
        $appointment->save();

        return redirect()->route('dashboard')
            ->with('success', 'Votre demande de rendez-vous a été enregistrée. Nous vous contacterons prochainement pour confirmer.');
    }

    /**
     * Mettre à jour le statut d'un rendez-vous
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $appointment->status = $validated['status'];
        $appointment->save();

        return redirect()->back()
            ->with('success', 'Statut du rendez-vous mis à jour avec succès.');
    }

    /**
     * Annuler un rendez-vous
     */
    public function cancel(Appointment $appointment)
    {
        // Vérifier que l'utilisateur a le droit d'annuler ce rendez-vous
        if (Auth::id() !== $appointment->user_id && !Auth::user()->isAdmin) {
            return redirect()->back()
                ->with('error', 'Vous n\'avez pas l\'autorisation d\'annuler ce rendez-vous.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->back()
            ->with('success', 'Rendez-vous annulé avec succès.');
    }
}
