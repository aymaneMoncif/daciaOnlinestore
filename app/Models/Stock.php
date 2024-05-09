<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    public function modeles()
    {
        return $this->belongsToMany(Modele::class, 'nommodele');
    }

    protected $fillable = ['status','modele_id','version_id','client_Id','etatfacturation','avancement','acquisition','compteproprietaire','n_chassis'];
}
