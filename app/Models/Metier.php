<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    use HasFactory;

    protected $fillable = ['nom','secteur_id'];

    public function secteur()
    {
        return $this->belongsTo(Secteur::class);
    }
    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'metier_stack');
    }

}
