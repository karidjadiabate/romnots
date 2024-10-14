<?php

namespace App\Http\Controllers;

use App\Models\DemandeInscription;
use App\Http\Requests\StoreDemandeInscriptionRequest;
use App\Http\Requests\UpdateDemandeInscriptionRequest;
use App\Models\Etablissement;
use App\Models\User;
use App\Notifications\AccepteNouvelleDemandeInscription;
use App\Notifications\NouveauCompteNotification;
use App\Notifications\NouvelleDemandeInscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Session;

class DemandeInscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listedemandeinscriptions = DemandeInscription::latest()->get();

        return view('admin.listedemande.listedemandeinscription', compact('listedemandeinscriptions'));
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
    public function store(StoreDemandeInscriptionRequest $request)
    {
        $validatedData = $request->validate(
            [
                'nom' => 'required|string',
                'prenom' => 'required|string',
                'nometablissement' => 'required|string',
                'email' => 'required|email|unique:demande_inscriptions,email',
                'contact' => 'required|string|max:20',
                'adresseetablissement' => 'required|string',
            ],
            [
                'nom.required' => 'Le nom est obligatoire.',
                'prenom.required' => 'Le prenom est obligatoire.',
                'nometablissement.required' => 'Le Nom d\'etablissement est obligatoire.',
                'contact.required' => 'Le contact est obligatoire.',
                'email.required' => 'L\'adresse email est obligatoire.',
                'email.unique' => 'Cet email est déjà associé à une demande d\'inscription.'
            ]
        );

        $demandeinscription = DemandeInscription::create([
            'nom' => $validatedData['nom'],
            'prenom' => $validatedData['prenom'],
            'nometablissement' => $validatedData['nometablissement'],
            'adresseetablissement' => $validatedData['adresseetablissement'],
            'email' => $validatedData['email'],
            'contact' => $validatedData['contact'],
        ]);

        // Envoyer la notification aux administrateurs
        $adminUsers = User::where('role_id', 6)->get();
        foreach ($adminUsers as $admin) {
            $admin->notify(new NouvelleDemandeInscription($demandeinscription));
        }


        return to_route('home')->with('success', 'Votre demande d\'inscription a bien été prise en compte, nous reviendrons vers vous par email.');
    }

    public function accept(Request $request, $id)
    {
        $demande = DemandeInscription::find($id);

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
            'contact' => $demande->contact,
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
                'contact' => $demande->contact,
                'email' => $demande->email,
                'role_id' => 5,
                'password' => $passwordHashed,
                'from_demande_inscription' => true
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
        $demande = DemandeInscription::find($id);
        if ($demande) {
            $demande->accepted = false;
            $demande->rejected = true;
            $demande->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Display the specified resource.
     */

    public function demandeinscriptionnotification(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->route('listedemandeinscription');
    }

    public function show(DemandeInscription $demandeInscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeInscription $demandeInscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDemandeInscriptionRequest $request, DemandeInscription $demandeInscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeInscription $demandeInscription)
    {
        //
    }
}
