<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'prix_equipements', 'version_id', 'equipement_id')
                    ->withPivot('prix');
    }

    public function couleurs()
    {
        return $this->belongsToMany(Couleur::class, 'prix_couleurs', 'version_id', 'couleur_id')
                    ->withPivot('prix');
    }
}
