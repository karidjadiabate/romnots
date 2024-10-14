<?php

namespace App\Http\Controllers;

use App\Models\EtablissementMatiere;
use App\Models\Matiere;
use Illuminate\Http\Request;

class MatiereEtablissementController extends Controller
{
    public function index()
    {
        $lesmatieres = Matiere::all();

        $nosmatieres = EtablissementMatiere::with('matiere')
            ->where('etablissement_id', auth()->user()->etablissement_id)
            ->get();

        return view('admin.etablissement.listematierebyschool',compact('lesmatieres','nosmatieres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required|array',
            'matiere_id.*' => 'exists:matieres,id',
        ]);

        $etablissementId = auth()->user()->etablissement_id;

        $lastCode = EtablissementMatiere::where('etablissement_id', $etablissementId)
        ->orderBy('code', 'desc')
        ->first();

        $lastCodeNumber = $lastCode ? (int) substr($lastCode->code, 3) : 0;

        foreach ($request->matiere_id as $matiereId) {
            $lastCodeNumber++; // Incrémenter le nombre

            // Générer le nouveau code
            $newCode = 'MAT' . str_pad($lastCodeNumber, 4, '0', STR_PAD_LEFT);

            EtablissementMatiere::create([
                'etablissement_id' => auth()->user()->etablissement_id,
                'matiere_id' => $matiereId,
                'coefficient' => $request->coefficient,
                'credit' => $request->credit,
                'volumehoraire' => $request->volumehoraire,
                'code' => $newCode,
            ]);
        }

        return to_route('admin.matiereindex')->with('success', 'Matières ajoutées avec succès!');
    }

    public function update(Request $request, $id)
    {

        $etablissementMatiere = EtablissementMatiere::findOrFail($id);

        $etablissementMatiere->update([
            //'matiere_id' => $request->matiere_id,
            'coefficient' => $request->coefficient,
            'credit' => $request->credit,
            'volumehoraire' => $request->volumehoraire,
        ]);

        return redirect()->route('admin.matiereindex')->with('success', 'Matière mise à jour avec succès!');
    }


    public function destroy($id)
    {
        $etablissementMatiere = EtablissementMatiere::findOrFail($id);

        $etablissementMatiere->delete();

        return redirect()->route('admin.matiereindex')->with('danger', 'Matière supprimée avec succès!');
    }

}
