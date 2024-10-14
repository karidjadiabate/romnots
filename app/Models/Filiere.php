<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Filiere extends Model
{
    use HasFactory;

    protected $fillable = ['nomfiliere','description'];

    /* public function listefilierebyecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $listefiliere = DB::table('etablissement_filiere AS ef')
            ->join('niveaux AS n','n.id','=','ef.niveau_id')
            ->join('filieres AS f','f.id','=','ef.filiere_id')
            ->leftJoin('classes AS c', 'c.etablissement_filiere_id', '=', 'ef.id')
            ->where('ef.etablissement_id','=', $ecoleId)
            ->select('f.id','f.nomfiliere','n.nomniveau','ef.niveau_id',DB::raw('COUNT(c.id) AS nbclasse'))
            ->groupBy('f.id', 'f.nomfiliere', 'n.nomniveau', 'ef.niveau_id')
            ->get();

        return  $listefiliere;
    } */

    public function classes()
    {
        return $this->hasManyThrough(Classe::class, EtablissementFiliere::class);
    }
}
