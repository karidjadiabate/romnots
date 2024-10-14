<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Classe;
use App\Models\Etablissement;
use App\Models\EtablissementFiliere;
use App\Models\Matiere;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NouveauCompteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function administrateur()
    {
        $fadministrateur = new User();

        $etablissements = Etablissement::all();

        $roles = Role::all();

        $connectedUserRole = auth()->user()->role_id;

        if ($connectedUserRole === 6) {
            // Superadmin
            $roles = Role::whereIn('id', [5])->get();
        } elseif ($connectedUserRole === 5) {
            // Utilisateur avec enseignement supérieur
            $roles = Role::whereIn('id', [1,2])->get();
        } else {
            // Autres utilisateurs
            $roles = Role::whereIn('id', [1,2])->get();
        }

        $administrateurs = $fadministrateur->administrateur();

        return view('admin.user.administrateur',compact('administrateurs','etablissements','roles'));
    }

    public function professeur()
    {
        $fprofesseur = new User();

        $fclasse = new Classe();

        $fmatiere = new Matiere();

        $matieres = $fmatiere->listematierebyecole();

        $classes = $fclasse->listeclassbyecole();

        $professeurs = $fprofesseur->listeprofesseurparecole();

        $etablissements = Etablissement::all();

        $roles = Role::all();

        $connectedUserRole = auth()->user()->role_id;

        if ($connectedUserRole === 6) {
            // Superadmin
            $roles = Role::whereIn('id', [5])->get();
        } elseif ($connectedUserRole === 5) {
            // Utilisateur avec enseignement supérieur
            $roles = Role::whereIn('id', [1,2])->get();
        } else {
            // Autres utilisateurs
            $roles = Role::whereIn('id', [1,2])->get();
        }


        return view('admin.user.professeur',compact('professeurs','roles','matieres','classes','etablissements'));
    }

    public function etudiant()
    {
        $fetudiant = new User();

        $fclasse = new Classe();

        $listefilieres = EtablissementFiliere::with('filiere')->where('etablissement_id', auth()->user()->etablissement_id)->get();

        $classes = $fclasse->listeclassbyecole();

        $etudiants = $fetudiant->listeetudiantparecole();

        $roles = Role::all();

        $connectedUserRole = auth()->user()->role_id;

        if ($connectedUserRole === 6) {
            // Superadmin
            $roles = Role::whereIn('id', [5])->get();
        } elseif ($connectedUserRole === 5) {
            $roles = Role::whereIn('id', [1,2])->get();
        } else {
            // Autres utilisateurs
            $roles = Role::whereIn('id', [1,2])->get();
        }


        return view('admin.user.etudiant',compact('etudiants','roles','classes','listefilieres'));
    }

    public function store(Request $request)
    {
        $isSuperUser = auth()->user()->role_id === 6;

        $media = $request->file('file');
        $name = null;

        if ($media) {
            $name = $media->hashName();
            $media->storeAs('public/profile', $name);
        }

        $passwordPlain = 'password';
        $passwordHashed = Hash::make($passwordPlain);

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => $passwordHashed,
            'image' => $name,
            'role_id' => $request->role_id,
            'matiere_id' => $request->matiere_id,
            'etablissement_id' => $request->etablissement_id,
            'classe_id' => $request->classe_id,
            'matricule' => $request->matricule,
            'genre' => $request->genre,
            'datenaiss' => $request->datenaiss,
            'adresse' => $request->adresse,
            'filiere_id' => $request->filiere_id,
        ];

        if ($request->role_id == 1) {
            $data['matiere_id'] = null; // Classe est null pour le rôle "professeur"
        }

        if (is_array($request->classe_id)) {
            $data['classe_id'] = $request->classe_id[0]; // Assurez-vous que classe_id est une chaîne de caractères
        } else {
            $data['classe_id'] = null; // Ou toute autre valeur par défaut appropriée
        }

        $adminEcoleId = null;
        if ($isSuperUser) {
            $adminEcoleId = $request->etablissement_id;
        } elseif (auth()->user()->role_id === 5) {
            $adminEcoleId = auth()->user()->etablissement_id;
        }

        $data['etablissement_id'] = $adminEcoleId;


        $user = User::create(Arr::except($data, ['matiere_id']));
         // Si l'utilisateur est un professeur
        if ($user->role_id == 2 && is_array($request->matiere_id)) {
            $matiereIds = implode(',', $request->matiere_id);
            $user->matiere_id = $matiereIds;
            $user->save();
        }

        $user->notify(new NouveauCompteNotification($user->email, $passwordPlain));

        if ($user->role_id == 1) {
            $user->classe_id = $request->classe_id;
            $user->save();

            return redirect()->route('etudiant')->with('success', 'Etudiant ajouté avec succès');
        } elseif ($user->role_id == 2) {
            // Si le rôle est professeur, vous pouvez traiter les classes sélectionnées ici
            $classes = $request->classe_id;

            if (is_array($classes)) {
                $user->selected_classes = json_encode($classes); // Stocker les classes sélectionnées sous forme de JSON
            } else {
                $user->selected_classes = json_encode([$classes]); // Stocker une seule classe sous forme de JSON
            }

            $user->save();

            return redirect()->route('professeur')->with('success', 'Professeur ajouté avec succès');
        }

        else{

            return redirect()->route('administrateur')->with('success', 'L\'administrateur ajouté avec succès');

        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        // Gérer le téléchargement de la nouvelle image de profil
        if ($request->hasFile('file')) {
            $media = $request->file('file');
            $name = $media->hashName();
            $path = $media->storeAs('public/profile', $name);

            // Mettre à jour les informations d'image de profil de l'utilisateur
            $data['image'] = $name;

            // Supprimer l'ancienne image de profil si elle existe
            if ($user->image) {
                Storage::delete('public/profile/' . $user->image);
            }
        }

        // Vérifier si un nouveau mot de passe a été saisi, puis le hasher avant de le sauvegarder
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Vérifier le rôle de l'utilisateur avant de mettre à jour les champs spécifiques à ce rôle
        if ($user->role_id == 1) {
            $user->classe_id = $request->classe_id;
            $user->matricule = $request->matricule;
            //$user->role_id = $request->role_id;
            $user->genre = $request->genre;
            $user->datenaiss = $request->datenaiss;
            $user->adresse = $request->adresse;
            $user->filiere_id = $request->filiere_id;
        } elseif ($user->role_id == 2) {
            if (is_array($request->matiere_id)) {
                $user->matiere_id = implode(',', $request->matiere_id);
            } else {
                $user->matiere_id = $request->matiere_id;
            }
            $user->nom = $request->nom;
            $user->prenom = $request->prenom;
            $user->email = $request->email;
            $user->matricule = $request->matricule;
            $user->contact = $request->contact;
            $classes = $request->classe_id;
            $user->adresse = $request->adresse;
            if (is_array($classes)) {
                $user->selected_classes = json_encode($classes);
            } else {
                $user->selected_classes = json_encode([$classes]);
            }
        } elseif ($user->role_id == 5) {
            $user->etablissement_id = $request->etablissement_id;
        }

        // Mettre à jour l'utilisateur dans la base de données
        $user->update($data);

        // Redirection en fonction du rôle de l'utilisateur
        if ($user->role_id == 1) {
            return redirect()->route('etudiant')->with('warning', 'Étudiant modifié avec succès');
        } elseif ($user->role_id == 2) {
            return redirect()->route('professeur')->with('warning', 'Professeur modifié avec succès');
        }
        else {
            return redirect()->route('administrateur')->with('warning', 'Administrateur modifié avec succès');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user->role_id == 1) {
            return to_route('etudiant')->with('danger','Etudiant supprimé avec success');
        }

        if ($user->role_id == 5) {
            return to_route('administrateur')->with('danger','Administrateur supprimé avec success');
        }

        if ($user->role_id == 2) {
            return redirect()->route('professeur')->with('danger', 'Professeur supprimé avec succès');
        }
    }

    public function moncompte()
    {
        return view('admin.compte.moncompte');
    }
}
