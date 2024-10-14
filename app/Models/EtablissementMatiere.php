<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtablissementMatiere extends Model
{
    use HasFactory;

    protected $table = 'etablissement_matiere';

    protected $fillable = ['code','etablissement_id','matiere_id','coefficient','credit','volumehoraire'];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
