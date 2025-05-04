<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Do not apply middleware directly in the constructor
        // The middleware is already applied in the route definition
    }

    /**
     * Store a newly created adoption request in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'animal_id' => 'required|exists:animals,id',
            'message' => 'required|string|min:20',
        ]);

        $animal = Animal::findOrFail($request->animal_id);

        // Check if animal is available
        if ($animal->status !== 'available') {
            return redirect()->back()->with('error', 'Cet animal n\'est plus disponible à l\'adoption.');
        }

        // Check if user already has a pending request for this animal
        $existingRequest = AdoptionRequest::where('user_id', Auth::id())
            ->where('animal_id', $request->animal_id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'Vous avez déjà une demande d\'adoption en cours pour cet animal.');
        }

        // Create the adoption request
        AdoptionRequest::create([
            'user_id' => Auth::id(),
            'animal_id' => $request->animal_id,
            'status' => 'pending',
            'message' => $request->message,
        ]);

        // Update the animal status to reserved
        $animal->update(['status' => 'reserved']);

        return redirect()->back()->with('success', 'Votre demande d\'adoption a été envoyée avec succès. Nous vous contacterons bientôt.');
    }

    /**
     * Cancel an adoption request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $adoptionRequest = AdoptionRequest::findOrFail($id);

        // Check if the request belongs to the current user
        if ($adoptionRequest->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à annuler cette demande.');
        }

        // Check if the request is still pending
        if ($adoptionRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Cette demande ne peut plus être annulée.');
        }

        // Update the adoption request status
        $adoptionRequest->update(['status' => 'rejected']);

        // Update the animal status back to available
        $animal = Animal::findOrFail($adoptionRequest->animal_id);
        $animal->update(['status' => 'available']);

        return redirect()->back()->with('success', 'Votre demande d\'adoption a été annulée avec succès.');
    }

    /**
     * Update the status of an adoption request (for admin use).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $adoptionRequest = AdoptionRequest::findOrFail($id);
        $animal = Animal::findOrFail($adoptionRequest->animal_id);

        // Update the adoption request status
        $adoptionRequest->update(['status' => $request->status]);

        // Update the animal status based on the adoption request status
        if ($request->status === 'approved') {
            $animal->update(['status' => 'adopted']);
            
            // Reject any other pending requests for this animal
            AdoptionRequest::where('animal_id', $animal->id)
                ->where('id', '!=', $adoptionRequest->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);
        } elseif ($request->status === 'rejected') {
            // Check if there are other pending requests for this animal
            $pendingRequests = AdoptionRequest::where('animal_id', $animal->id)
                ->where('status', 'pending')
                ->count();

            if ($pendingRequests === 0) {
                $animal->update(['status' => 'available']);
            }
        }

        return redirect()->back()->with('success', 'Le statut de la demande d\'adoption a été mis à jour avec succès.');
    }
} 