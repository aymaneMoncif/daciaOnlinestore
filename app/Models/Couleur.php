<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    use HasFactory;

    public function versions()
    {
        return $this->belongsToMany(Version::class, 'prix_couleurs', 'couleur_id', 'version_id')
                    ->withPivot('prix');
    }

    public function images()
    {
        return $this->hasMany(ImagesThreeSixty::class);
    }
}
