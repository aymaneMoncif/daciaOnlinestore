<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aport extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'nombanque', 'numerotransaction', 'imagerecu','client_id','type_paiement','signature'];

    public function Commande(){
        return $this->belongsTo(Commande::class);
    }
    public function user(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
