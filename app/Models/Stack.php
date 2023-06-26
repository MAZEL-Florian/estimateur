<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function specialisations()
    {
        return $this->belongsToMany(Specialisation::class, 'specialisation_stack');
    }

    public function metiers()
    {
        return $this->belongsToMany(Metier::class, 'metier_stack');
    }
}
