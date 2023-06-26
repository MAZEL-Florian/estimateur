<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function frameworks()
    {
        return $this->belongsToMany(Framework::class, 'frameworks_specialisation');
    }
    public function stacks()
    {
        return $this->belongsToMany(Stack::class, 'specialisation_stack');
    }
}
