<?php

namespace App\Http\Controllers;

use App\Models\Etablissement;
use App\Http\Requests\StoreEtablissementRequest;
use App\Http\Requests\UpdateEtablissementRequest;
use App\Models\DemandeInscription;
use Illuminate\Support\Facades\Storage;

class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etablissements = Etablissement::all();

        return view('admin.etablissement.listeetablissement',compact('etablissements'));
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
    public function store(StoreEtablissementRequest $request)
    {
        $media = $request->file('file');
        $name = null;

        if ($media) {
            $name = $media->hashName();
            $media->storeAs('public/logo', $name);
        }

        $ecoleData = $request->only(['code', 'nomresponsable', 'prenomresponsable', 'nometablissement','contact', 'adresse']);
        $ecoleData['logo'] = $name;

        $ecole = Etablissement::create($ecoleData);

        return redirect()->route('etablissement.index')->with('success','Etablissement ajoutée avec succès!');

    }




    /**
     * Display the specified resource.
     */
    public function show(Etablissement $etablissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etablissement $etablissement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEtablissementRequest $request, $id)
    {
        $ecole = Etablissement::find($id);

        if ($request->hasFile('file')) {
            $media = $request->file('file');
            $name = $media->hashName();
            $path = $media->storeAs('public/logo', $name);

            // Supprimer l'ancienne image de profil si elle existe
            if ($ecole->logo) {
                Storage::delete('public/logo/' . $ecole->logo);
            }

            // Mettre à jour les informations du fichier
            $ecole->logo = $name;
        }

        // Mettre à jour les autres champs de l'école
        $ecole->code = $request->code;
        $ecole->nomresponsable = $request->input('nomresponsable');
        $ecole->prenomresponsable = $request->input('prenomresponsable');
        $ecole->nometablissement = $request->input('nometablissement');
        $ecole->contact = $request->input('contact');
        $ecole->adresse = $request->input('adresse');

        $ecole->save();

        return redirect()->route('etablissement.index')->with('warning', 'Etablissement modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ecole = Etablissement::findOrFail($id);

        $ecole->delete();

        return to_route('etablissement.index')->with('Etablissement','Ecole supprimée avec success!');
    }
}
