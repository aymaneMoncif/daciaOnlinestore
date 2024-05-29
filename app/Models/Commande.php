<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['Status_commande','modele_id','total', 'version_id', 'couleur_id','client_id','n_chassis','CC_status', 'CC_Comment', 'Commercial_Status', 'Commercial_Comment'];


    public function equipements(){
        return $this->belongsToMany(Equipement::class, 'commande_equipements');
    }

    public function Client(){
        return $this->belongsTo(Client::class);
    }

    public function Modele(){
        return $this->belongsTo(Modele::class);
    }

    public function Version(){
        return $this->belongsTo(Version::class);
    }

    public function Aport(){
        return $this->hasOne(Aport::class);
    }

    public function DossierAchat(){
        return $this->hasOne(DossierAchat::class);
    }

    public function Paiement(){
        return $this->hasOne(Paiement::class);
    }
}
