<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use App\Models\Etablissement;
use App\Models\User;
use App\Notifications\NouveauCompteNotification;
use App\Notifications\NouvelleDemandeDemo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class DemoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listedemandemos = Demo::latest()->get();

        return view('admin.listedemande.listedemandedemo', compact('listedemandemos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nometablissement' => 'required|string|max:255',
            'email' => 'required|email|unique:demos,email',
            'numerotel' => 'required|string|max:20'
        ],[
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.unique' => 'Cet email est déjà associé à une demande de démo.'
        ]);

        $demo = Demo::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'nometablissement' => $validatedData['nometablissement'],
            'email' => $validatedData['email'],
            'numerotel' => $validatedData['numerotel']
        ]);

        // Envoyer la notification aux administrateurs
        $adminUsers = User::where('role_id', 6)->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(new NouvelleDemandeDemo($demo));
        }


        return to_route('home')->with('success', 'Votre demande de démo a bien été prise en compte, nous reviendrons vers vous par email avec vos identifiants après validation.');
    }

    public function accept(Request $request, $id)
    {
        $demande = Demo::find($id);

        if (!$demande) {
            return response()->json(['success' => false, 'message' => 'Demande non trouvée.']);
        }

        $passwordPlain = 'password';
        $passwordHashed = Hash::make($passwordPlain);

        // Valider les données
        $datademoEtablissement = [
            'code' => $demande->code,
            'nomresponsable' => $demande->nom,
            'prenomresponsable' => $demande->prenom,
            'nometablissement' => $demande->nometablissement,
            'contact' => $demande->numerotel,
            'adresse' => $demande->adresseetablissement,
            'logo' => null,
        ];

        try {
            // Créer l'établissement
            $etablissement = Etablissement::create($datademoEtablissement);

            // Préparer les données pour l'admin avec l'ID de l'établissement créé
            $dataAdmin = [
                'nom' => $demande->nom,
                'prenom' => $demande->prenom,
                'etablissement_id' => $etablissement->id, // Utiliser l'ID de l'établissement créé
                'contact' => $demande->numerotel,
                'email' => $demande->email,
                'role_id' => 5,
                'password' => $passwordHashed
            ];

            Log::info('Données à insérer dans l\'établissement:', $datademoEtablissement);
            Log::info('Données à insérer dans l\'admin:', $dataAdmin);

            // Créer l'utilisateur admin
            $admin = User::create($dataAdmin);
            $admin->notify(new NouveauCompteNotification($admin->email, $passwordPlain));

        } catch (Exception $e) {
            Log::error('Erreur lors de la création de l\'admin: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur lors de la création de l\'établissement.']);
        }

        // Marquer la demande comme acceptée
        $demande->accepted = true;
        $demande->rejected = false;
        $demande->save();

        return response()->json(['success' => true, 'message' => 'Demande acceptée et établissement créé avec succès!']);
    }


    public function reject($id)
    {
        $demande = Demo::find($id);
        if ($demande) {
            $demande->accepted = false;
            $demande->rejected = true;
            $demande->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }


    public function demonotification(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->route('listedemandedemo');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demo $demo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demo $demo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Demo $demo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demo $demo)
    {
        //
    }
}
