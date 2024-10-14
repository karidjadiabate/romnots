<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Http\Requests\StoreFiliereRequest;
use App\Http\Requests\UpdateFiliereRequest;
use App\Imports\FiliereImport;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $filieres = Filiere::all();

        return view('admin.filiere.listefiliere',compact('filieres'));
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
        Filiere::create([
            'nomfiliere' => $request->nomfiliere,
            'description' => $request->description,
        ]);

        return to_route('filiere.index')->with('success','Filière ajoutée avec success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFiliereRequest $request, Filiere $filiere)
    {
        $filiere->update([
            'nomfiliere' => $request->nomfiliere,
            'description' => $request->description,
        ]);

        return to_route('filiere.index')->with('warning', 'Filière modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $filiere = Filiere::findOrFail($id);

        $filiere->delete();

        return to_route('filiere.index')->with('danger','Filière supprimée avec success!');
    }

    public function importFiliereExcelData(Request $request)
    {
        // Valider le fichier d'importation
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        try {
            // Importer les données Excel
            Excel::import(new FiliereImport, $request->file('import_file'));

            return redirect()->back()->with('status', 'Importation réussie avec succès !');
        } catch (\Exception $e) {
            // En cas d'erreur, rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }
}
