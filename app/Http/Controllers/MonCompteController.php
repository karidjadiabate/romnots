<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MonCompteController extends Controller
{
    public function updatepassword(Request $request)
    {
        $user = Auth::user();

        // Validate the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Validate the new password and confirm it
        $this->validate($request, [
            'password' => 'required|string|min:3|confirmed',
        ], [
            'password.required' => 'The new password is required.',
            'password.min' => 'The new password must be at least :min characters.',
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);

        // Update the username if provided
        if ($request->filled('email')) {
            $user->email = $request->input('email');
        }

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateprofile(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if ($request->hasFile('file')) {
            $media = $request->file('file');
            $name = $media->hashName();
            $media->storeAs('public/profile', $name);

            // Supprimer l'ancienne image de profil si elle existe
            if ($user->image) {
                Storage::delete('public/profile/' . $user->image);
            }

            $user->image = $name;
        }

        // Mettre à jour les autres informations de l'utilisateur
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->adresse = $request->adresse;

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
