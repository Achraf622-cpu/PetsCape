<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Donation;
use App\Http\Controllers\Controller;

class DonationController extends Controller
{
    public function showDonationForm()
    {
        return view('donation.form');
    }

    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Don pour PetsCape',
                        ],
                        'unit_amount' => $request->amount * 100, // amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('donation.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('donation.cancel'),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe error: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la création de la session de paiement.');
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('donation.form')->with('error', 'Session ID manquante');
        }

        try {
            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            
            // Retrieve the session to get payment details
            $session = Session::retrieve($sessionId);
            
            // Save donation in database if session was paid
            if ($session->payment_status === 'paid') {
                $amount = $session->amount_total / 100; // Convert from cents
                
                Donation::create([
                    'user_id' => auth()->id(),
                    'amount' => $amount,
                    'stripe_session_id' => $sessionId,
                    'status' => 'completed',
                ]);
                
                return view('donation.success', ['amount' => $amount]);
            } else {
                return redirect()->route('donation.form')->with('error', 'Le paiement n\'a pas été complété');
            }
        } catch (\Exception $e) {
            Log::error('Stripe error on success page: ' . $e->getMessage());
            return redirect()->route('donation.form')->with('error', 'Une erreur est survenue lors de la vérification du paiement');
        }
    }

    public function cancel()
    {
        return view('donation.cancel');
    }
} 