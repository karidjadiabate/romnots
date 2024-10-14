<?php

namespace App\Http\Controllers;

use App\Models\EtablissementFiliere;
use App\Models\Filiere;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiliereEtablissementController extends Controller
{
    public function index()
    {
        $lesfilieres = Filiere::all();

        $niveaux = Niveau::all();

        $nosfilieres = DB::table('etablissement_filiere AS ef')
        ->leftJoin('classes AS c', function ($join) {
            // Relier etablissement_filiere_id de classes avec id de etablissement_filiere et vérifier le niveau
            $join->on('ef.id', '=', 'c.etablissement_filiere_id')
                ->whereRaw("JSON_CONTAINS(ef.niveau_id, CONCAT('\"', c.niveau_id, '\"'))"); // Vérification du niveau dans le tableau JSON
        })
        ->leftJoin('filieres AS f', 'ef.filiere_id', '=', 'f.id')
        ->leftJoin('niveaux AS n', function ($join) {
            // Relier les niveaux de etablissement_filiere
            $join->whereRaw("JSON_CONTAINS(ef.niveau_id, CONCAT('\"', n.id, '\"'))");
        })
        ->where('ef.etablissement_id', auth()->user()->etablissement_id)
        ->select(
            'ef.*',
            'f.nomfiliere',
            DB::raw('GROUP_CONCAT(DISTINCT n.code SEPARATOR ", ") AS niveaux'), // Concaténer les niveaux
        )
        ->groupBy('ef.id', 'f.nomfiliere','ef.code','etablissement_id','ef.filiere_id','ef.niveau_id','ef.directeurfiliere',
        'ef.nbclasse','ef.created_at','ef.updated_at')
        ->get();


        return view('admin.etablissement.listefilierebyschool',compact('lesfilieres','nosfilieres','niveaux'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|array',
            'niveau_id.*' => 'exists:niveaux,id',
        ]);

        $etablissementId = auth()->user()->etablissement_id;

        $lastCode = EtablissementFiliere::where('etablissement_id', $etablissementId)
        ->orderBy('code', 'desc')
        ->first();

        $lastCodeNumber = $lastCode ? (int) substr($lastCode->code, 3) : 0;

        // Générer le nouveau code
        $newCode = 'FIL' . str_pad(++$lastCodeNumber, 3, '0', STR_PAD_LEFT);

        // Créer l'entrée avec les niveaux en JSON
        EtablissementFiliere::create([
            'etablissement_id' => auth()->user()->etablissement_id,
            'filiere_id' => $request->filiere_id,
            'niveau_id' => json_encode($request->niveau_id), // Convertir les niveaux en JSON
            'directeurfiliere' => $request->directeurfiliere,
            'nbclasse' => $request->nbclasse,
            'code' => $newCode,
        ]);

        return to_route('admin.filiereindex')->with('success', 'Filière et niveaux ajoutés avec succès!');
    }


    public function update(Request $request, $id)
    {
        // Validation des champs
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|array',
            'niveau_id.*' => 'exists:niveaux,id',
            'nbclasse' => 'required|numeric',
            'directeurfiliere' => 'required|string',
        ]);

        // Trouver l'entrée à mettre à jour
        $etablissementFiliere = EtablissementFiliere::findOrFail($id);

        // Mettre à jour les données
        $etablissementFiliere->update([
            'filiere_id' => $request->filiere_id,
            'niveau_id' => json_encode($request->niveau_id), // Convertir en JSON
            'directeurfiliere' => $request->directeurfiliere,
            'nbclasse' => $request->nbclasse,
        ]);

        // Redirection après la mise à jour avec un message de succès
        return redirect()->route('admin.filiereindex')->with('success', 'Filière mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $etablissementFiliere = EtablissementFiliere::findOrFail($id);

        $etablissementFiliere->delete();

        return redirect()->route('admin.filiereindex')->with('danger', 'Filière supprimée avec succès!');
    }

}
