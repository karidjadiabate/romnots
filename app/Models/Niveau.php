<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = ['code','nomniveau','etablissement_id'];

    public function listeniveauxbyecole()
    {
        $listefiliere = DB::table('niveaux')
            ->select('id','nomniveau','code')
            ->get();

        return  $listefiliere;
    }
}
