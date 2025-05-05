<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only(['verify', 'resend']);
    }

    public function notice(Request $request)
    {
        // If already verified, redirect to dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.verify');
    }

    public function verify(EmailVerificationRequest $request)
    {
        // If already verified, redirect to dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard')->with('verified', true);
        }
        
        $request->fulfill();
        
        // Add session flash message that will be displayed on the dashboard
        return redirect()->route('dashboard')->with('success', 'Votre email a été vérifié avec succès!');
    }

    public function resend(Request $request)
    {
        // If already verified, redirect to dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }
}
