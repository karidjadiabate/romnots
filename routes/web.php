<?php

use App\Http\Controllers\CalendrierController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeInscriptionController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\FiliereEtablissementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\MatiereEtablissementController;
use App\Http\Controllers\MonCompteController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\SujetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nos-tarifs',[ClientController::class,'nostarifs'])->name('nostarifs');
Route::get('/demandeinscription',[ClientController::class,'demandeinscription'])->name('demandeinscription');
Route::post('/demandeinscription',[DemandeInscriptionController::class,'store'])->name('demandeinscription.store');
Route::post('/demo',[DemoController::class,'store'])->name('demo.store');
Route::get('/moncompte',[UserController::class,'moncompte'])->name('moncompte');


Route::resource('user', UserController::class)->except(['create','show','edit']);

//Route superUSer
Route::prefix('superadmin')->middleware('SuperUtilisateur')->group(function () {

    Route::get('/',[DashboardController::class,'dashboard'])->name('superadmin.dashboard');
    Route::get('/listedemandeinscription',[DemandeInscriptionController::class,'index'])->name('listedemandeinscription');
    Route::get('/listedemandedemo',[DemoController::class,'index'])->name('listedemandedemo');
    Route::get('/administrateur',[UserController::class,'administrateur'])->name('administrateur');
    Route::resource('etablissement',EtablissementController::class);

    Route::get('/listedemandedemo/{notification}',[DemoController::class,'demonotification'])->name('demo.notification');
    Route::get('/listedemandeinscription/{notification}',[DemandeInscriptionController::class,'demandeinscriptionnotification'])->name('demandeinscription.notification');

    Route::post('/acceptdemandeinscription/{id}', [DemandeInscriptionController::class, 'accept'])->name('demandeinscription.accept');
    Route::post('/rejectdemandeinscription/{id}', [DemandeInscriptionController::class, 'reject'])->name('demandeinscription.reject');

    Route::post('/acceptdemandedemo/{id}', [DemoController::class, 'accept'])->name('demo.accept');
    Route::post('/rejectdemandedemo/{id}', [DemoController::class, 'reject'])->name('demo.reject');

    Route::get('/apropos',[ClientController::class,'apropos'])->name('apropos.superadmin');
    Route::get('/aideconfidentialite',[ClientController::class,'aideconfidentialite'])->name('aideconfidentialite.superadmin');

    Route::post('/changepassword/update', [MonCompteController::class, 'updatepassword'])->name('updatepassword.superadmin');
    Route::post('/updateprofile/{id}', [MoncompteController::class, 'updateprofile'])->name('updateprofile.superadmin');

    Route::resource('filiere', FiliereController::class);
    Route::resource('matiere', MatiereController::class);

    Route::post('matiere/import', [MatiereController::class, 'importMatiereExcelData'])->name('superadmin.importmatiere');
    Route::post('filiere/import', [FiliereController::class, 'importFiliereExcelData'])->name('superadmin.importfiliere');
});


 //ADMIN
 Route::prefix('admin')->middleware(['auth', 'admin', 'checkFromDemandeInscription','changepassword'])->group(function () {

    Route::get('/',[DashboardController::class,'dashboard'])->name('admin.dashboard');

    Route::get('/matiere',[MatiereEtablissementController::class,'index'])->name('admin.matiereindex');
    Route::post('/matiere',[MatiereEtablissementController::class,'store'])->name('storeadmin.matiere');
    Route::put('/matiere/{id}',[MatiereEtablissementController::class,'update'])->name('updateadmin.matiere');
    Route::delete('/matiere/{id}',[MatiereEtablissementController::class,'destroy'])->name('destroyadmin.matiere');

    Route::get('/filiere',[FiliereEtablissementController::class,'index'])->name('admin.filiereindex');
    Route::post('/filiere',[FiliereEtablissementController::class,'store'])->name('storeadmin.filiere');
    Route::put('/filiere/{id}',[FiliereEtablissementController::class,'update'])->name('updateadmin.filiere');
    Route::delete('/filiere/{id}',[FiliereEtablissementController::class,'destroy'])->name('destroyadmin.filiere');

    /* Route::resource('filiere', FiliereController::class); */
    Route::resource('classe', ClasseController::class);
    Route::resource('niveau', NiveauController::class);
    Route::get('/professeur',[UserController::class,'professeur'])->name('professeur');
    Route::get('/etudiant',[UserController::class,'etudiant'])->name('etudiant');
    Route::get('/calendrier',[CalendrierController::class,'index'])->name('calendrier.admin');

    Route::get('/apropos',[ClientController::class,'apropos'])->name('apropos.admin');
    Route::get('/aideconfidentialite',[ClientController::class,'aideconfidentialite'])->name('aideconfidentialite.admin');

    Route::post('/changepassword/update', [MonCompteController::class, 'updatepassword'])->name('updatepassword.admin');
    Route::post('/updateprofile/{id}', [MoncompteController::class, 'updateprofile'])->name('updateprofile.admin');

    Route::get('/sujet',[SujetController::class,'index'])->name('sujet.admin');
    Route::get('/creersujet',[SujetController::class,'create'])->name('sujetadmin.create');
    Route::post('/sujet',[SujetController::class,'store'])->name('sujetadmin.store');

    Route::get('/parametre',[ParametreController::class,'index'])->name('parametre.admin');
});


//Professeur
Route::prefix('professeur')->middleware(['professeur','changepassword'])->group(function () {

    Route::get('/',[DashboardController::class,'dashboard'])->name('professeur.dashboard');

    Route::get('/sujet',[SujetController::class,'index'])->name('sujet.professeur');
    Route::get('/creersujet',[SujetController::class,'create'])->name('sujetprofesseur.create');
    Route::post('/sujet',[SujetController::class,'store'])->name('sujetprofesseur.store');

    Route::get('/calendrier',[CalendrierController::class,'index'])->name('calendrier.professeur');

    Route::get('/apropos',[ClientController::class,'apropos'])->name('apropos.professeur');
    Route::get('/aideconfidentialite',[ClientController::class,'aideconfidentialite'])->name('aideconfidentialite.professeur');

    Route::post('/changepassword/update', [MoncompteController::class, 'updatepassword'])->name('updatepassword.professeur');
    Route::post('/updateprofile/{id}', [MoncompteController::class, 'updateprofile'])->name('updateprofile.professeur');
});

Route::post('/verify-email', [EmailVerificationController::class, 'verifyEmail']);

Route::get('password/change', [PasswordChangeController::class, 'showChangeForm'])->name('password.change');
Route::post('password/change', [PasswordChangeController::class, 'changePassword']);
