<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'nomclasse', 'etablissement_filiere_id', 'etablissement_id', 'niveau_id','nbclasse'];

    public function listeclassbyecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $listeclasse = DB::table('classes AS c')
            ->where('c.etablissement_id', '=', $ecoleId)
            ->join('etablissement_filiere AS ef', 'ef.filiere_id', '=', 'c.etablissement_filiere_id')
            ->join('filieres AS f', 'f.id', '=', 'ef.filiere_id')
            ->join('niveaux AS n','n.id','=','c.niveau_id')
            ->leftJoin('users AS u', 'u.classe_id', '=', 'c.id')
            ->select(
                'c.id',
                'f.nomfiliere',
                'c.code',
                'c.nomclasse',
                'c.nbclasse',
                'ef.filiere_id',
                'etablissement_filiere_id',
                'c.niveau_id',
                DB::raw("GROUP_CONCAT(n.nomniveau SEPARATOR ', ') AS nomniveau"), // Récupérer les noms des niveaux
            )
            ->groupBy('c.id', 'f.nomfiliere', 'c.code', 'c.nomclasse', 'c.nbclasse','c.niveau_id', 'etablissement_filiere_id', 'ef.filiere_id')
            ->get();

        return $listeclasse;
    }



    public function etablissementFiliere()
    {
        return $this->belongsTo(EtablissementFiliere::class);
    }


    public function etablissementMatiere()
    {
        return $this->belongsTo(EtablissementMatiere::class, 'etablissement_matiere_id');
    }
}
