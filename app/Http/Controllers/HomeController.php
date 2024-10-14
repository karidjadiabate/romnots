<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role_id == 6) {
                return redirect()->route('superadmin.dashboard');
            }

            if ($user->role_id == 5) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role_id == 2) {
                return redirect()->route('professeur.dashboard');
            }

            return redirect()->route('home');
        }

        return view('frontend.home');
    }
}
