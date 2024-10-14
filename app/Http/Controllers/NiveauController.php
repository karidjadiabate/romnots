<?php

namespace App\Http\Controllers;

use App\Models\Niveau;
use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fniveau = new Niveau();

        $niveaux = $fniveau->listeniveauxbyecole();

        return view('admin.niveau.listeniveau',compact('niveaux'));
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
        Niveau::create([
            'code' => $request->code,
            'nomniveau' => $request->nomniveau,
            'etablissement_id' => auth()->user()->etablissement_id,
        ]);

        return to_route('niveau.index')->with('success','Niveau ajoutée avec success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNiveauRequest $request, Niveau $niveau)
    {
        $niveau->update([
            'code' => $request->code,
            'nomniveau' => $request->nomniveau,
            'etablissement_id' => auth()->user()->etablissement_id,
        ]);

        return to_route('niveau.index')->with('warning', 'Niveau modifiée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $niveau = Niveau::findOrFail($id);

        $niveau->delete();

        return to_route('filiere.index')->with('danger','Niveau supprimée avec success!');
    }
}
