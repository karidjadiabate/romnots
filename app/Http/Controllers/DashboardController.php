<?php

namespace App\Http\Controllers;

use App\Models\DemandeInscription;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $fuser = new User();
        $nbetudiant = $fuser->nbetudiantparecole();
        $nbprofesseur = $fuser->nbprofesseurparecole();
        $nbfiliere = $fuser->nbfiliereparecole();
        $nbsujet = $fuser->nbsujetgenereparecole();

        $nbetablissementaccepte = DemandeInscription::where('accepted', 1)->count();
        $nbetablissementrefuse = DemandeInscription::where('rejected', 1)->count();

        $nbadmin = User::where('role_id', 5)->count();

        return view('admin.dashboard',compact('nbetablissementaccepte','nbetablissementrefuse','nbadmin','nbetudiant',
        'nbprofesseur','nbfiliere','nbsujet'));
    }
}
