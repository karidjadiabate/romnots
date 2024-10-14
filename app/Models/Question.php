<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'libquestion','user_id'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
}
