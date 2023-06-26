<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['annee', 'salaire'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function secteurs()
    {
        return $this->belongsTo(Secteur::class);
    }
}
