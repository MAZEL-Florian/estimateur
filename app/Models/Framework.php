<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function specialisations()
    {
        return $this->belongsToMany(Specialisation::class, 'frameworks_specialisation');
    }
}
