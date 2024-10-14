<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function showChangeForm()
    {
        return view('auth.changemdpfirstco');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:3',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->must_change_password = false;
        $user->save();

        if(auth()->user()->role_id === 5){
            return redirect()->route('admin.dashboard')->with('status', 'Mot de passe changé avec succès !');
        }elseif(auth()->user()->role_id === 2){
            return redirect()->route('professeur.dashboard')->with('status', 'Mot de passe changé avec succès !');
        }elseif(auth()->user()->role_id === 6){
            return redirect()->route('superadmin.dashboard')->with('status', 'Mot de passe changé avec succès !');
        }
    }
}
