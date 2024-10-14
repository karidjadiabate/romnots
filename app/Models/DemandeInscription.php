<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class DemandeInscription extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['prenom','nom','contact','email','nometablissement','adresseetablissement'];
}
