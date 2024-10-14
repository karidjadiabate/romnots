<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\EtablissementFiliere;
use App\Models\Filiere;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fclasse = new Classe();

        $listefilieres = EtablissementFiliere::with('filiere')->where('etablissement_id', auth()->user()->etablissement_id)->get();

        foreach ($listefilieres as $filiere) {
            $filiere->niveaux = json_decode($filiere->niveau_id); // Convertir JSON en tableau
        }

        $classes = $fclasse->listeclassbyecole();

        return view('admin.classe.listeclasse',compact('classes','listefilieres'));
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

        $lastClass = Classe::orderBy('code', 'desc')->first();
        $lastClassNumber = $lastClass ? (int) $lastClass->code : 0;

        // Générer le nouveau code au format 0001, 0002, etc.
        $newCode = str_pad(++$lastClassNumber, 4, '0', STR_PAD_LEFT);

        // Enregistrer la classe
        Classe::create([
            'etablissement_filiere_id' => $request->etablissement_filiere_id,
            'etablissement_id' => auth()->user()->etablissement_id,
            'nomclasse' => $request->nomclasse,
            'niveau_id' => $request->niveau_id,
            'nbclasse' => $request->nbclasse,
            'code' => $newCode,
        ]);

        return redirect()->route('classe.index')->with('success', 'Classe ajoutée avec succès!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        $classe->update([
            'nomclasse' => $request->nomclasse,
            'filiere_id' => $request->filiere_id,
            'niveau_id' => $request->niveau_id,
            'nbclasse' => $request->nbclasse,
            'etablissement_id' => auth()->user()->etablissement_id,
        ]);

        return to_route('classe.index')->with('warning', 'Classe modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();

        return to_route('classe.index')->with('danger','Classe supprimé avec success');
    }
}
