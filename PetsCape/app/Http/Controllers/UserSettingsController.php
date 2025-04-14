<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserSettingsController extends Controller
{
    /**
     * Show the settings dashboard.
     */
    public function index()
    {
        return view('settings.index');
    }
    
    /**
     * Show the profile edit form.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('settings.profile', compact('user'));
    }
    
    /**
     * Update the user's profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
        ]);
        
        // Check if email changed
        $emailChanged = $user->email !== $validated['email'];
        
        if ($emailChanged) {
            $validated['email_verified_at'] = null;
        }
        
        $user->update($validated);
        
        if ($emailChanged) {
            $user->sendEmailVerificationNotification();
            return redirect()->route('settings.profile')
                ->with('success', 'Profil mis à jour avec succès. Veuillez vérifier votre nouvelle adresse email.');
        }
        
        return redirect()->route('settings.profile')
            ->with('success', 'Profil mis à jour avec succès !');
    }
    
    /**
     * Show the password change form.
     */
    public function editPassword()
    {
        return view('settings.password');
    }
    
    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($validated['password']);
        $user->save();
        
        return redirect()->route('settings.password')
            ->with('success', 'Mot de passe modifié avec succès !');
    }
    
    /**
     * Show the account deletion form.
     */
    public function editAccount()
    {
        return view('settings.account');
    }
    
    /**
     * Delete the user's account.
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password',
        ]);
        
        $user = Auth::user();
        Auth::logout();
        
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('success', 'Votre compte a été supprimé avec succès.');
    }
} 