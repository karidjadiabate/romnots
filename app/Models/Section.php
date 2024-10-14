<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['sujet_id', 'titre', 'soustitre','user_id'];

    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
