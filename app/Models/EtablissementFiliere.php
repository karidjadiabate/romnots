<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtablissementFiliere extends Model
{
    use HasFactory;

    protected $table = 'etablissement_filiere';

    protected $fillable = ['code','etablissement_id','filiere_id','niveau_id','directeurfiliere','nbclasse'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveaux()
    {
        // Décode le JSON et récupère les niveaux en tant que collection
        return Niveau::whereIn('id', json_decode($this->niveau_id, true))->get();
    }


    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
