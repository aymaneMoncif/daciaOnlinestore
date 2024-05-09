<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    public function versions()
    {
        return $this->belongsToMany(Version::class, 'prix_equipements')->withPivot('prix');
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_equipements');
    }
}
