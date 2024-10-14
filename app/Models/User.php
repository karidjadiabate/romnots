<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'role_id',
        'classe_id',
        'selected_classes',
        'matiere_id',
        'etablissement_id',
        'contact',
        'email',
        'genre',
        'datenaiss',
        'password',
        'adresse',
        'image',
        'filiere_id',
        'from_demande_inscription'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function etablissement()
    {
        return $this->belongsTo(Etablissement::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    //Liste des administrateurs de chaque école
    public function administrateur()
    {
        $administrateurs = DB::table('users AS u')
            ->join('etablissements AS e', 'e.id', '=', 'u.etablissement_id')
            ->where('u.role_id', '=', 5)
            ->select('u.id', 'u.nom','u.prenom','u.image', 'u.contact', 'u.adresse', 'e.nometablissement','u.etablissement_id','u.email','u.password')
            ->get();

        return $administrateurs;
    }

    //Liste des professeurs de chaque école
    public function listeprofesseurparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $professeurs = DB::table('users AS u')
            ->join('etablissements AS e', 'e.id', '=', 'u.etablissement_id')
            ->where('u.role_id', '=', 2)
            ->select('u.id', 'u.nom','u.prenom','u.image', 'u.contact', 'e.nometablissement','u.email',
            'u.password','u.matiere_id','selected_classes','u.adresse',
            DB::raw('GROUP_CONCAT(DISTINCT (c.nomclasse)) as nomclasses'),
            DB::raw('GROUP_CONCAT(DISTINCT m.nommatiere) as nommatieres'))

            ->leftJoin('classes AS c', function ($join) {
                $join->whereRaw("JSON_CONTAINS(u.selected_classes, CONCAT('\"', c.id, '\"'))");
            })
            ->leftJoin('matieres AS m', function ($join) {
                $join->whereRaw("FIND_IN_SET(m.id, u.matiere_id)");
            })
            ->where('u.etablissement_id', '=', $ecoleId)
            ->groupBy('u.id', 'u.email', 'u.nom', 'u.prenom', 'u.image', 'u.contact',
            'u.password','e.nometablissement','u.matiere_id','u.selected_classes','u.adresse')
            ->get();

        return $professeurs;
    }

    //Liste des professeurs de chaque école
    public function listeetudiantparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $etudiants = DB::table('users AS u')
            ->join('etablissements AS e', 'e.id', '=', 'u.etablissement_id')
            ->join('classes AS c','c.id','=','u.classe_id')
            ->where('u.role_id', '=', 1)
            ->where('u.etablissement_id', '=', $ecoleId)
            ->select('u.id', 'u.nom','u.prenom','u.image', 'u.contact', 'e.nometablissement','u.email','u.adresse','u.password',
            'u.matricule','c.nomclasse','u.datenaiss','u.classe_id','genre','u.filiere_id')
            ->get();

        return $etudiants;
    }

    // Requête pour récupérer le nombre d'étudiants en fonction de l'admin de l'école
    public function nbetudiantparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $nbetudiant =  User::where('role_id', 1)
            ->where('etablissement_id', $ecoleId)
            ->count();

        return $nbetudiant;
    }

    //Requête pour récup le nombre de prof en fonction de l'admin de l'école connectée
    public function nbprofesseurparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $nbprofesseur = User::where('role_id', 2)
            ->where('etablissement_id', $ecoleId)
            ->count();

        return $nbprofesseur;
    }

    public function nbfiliereparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $nbfiliere = EtablissementFiliere::where('etablissement_id', $ecoleId)
            ->count();

        return $nbfiliere;
    }

    public function nbsujetgenereparecole()
    {
        $ecoleId = auth()->user()->etablissement_id;

        $nbsujet = Sujet::where('etablissement_id',$ecoleId)
            ->count();

        return $nbsujet;
    }
}
