<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if ($user) {
            // L'adresse e-mail existe déjà
            return response()->json(false, 200);
        }

        // L'adresse e-mail est unique
        return response()->json(true, 200);
    }
}
