<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cardpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'codecmr',
        'repauto',
        'emailrd',
        'nomprenom',
        'numTrans',
        'numautorisation',
        'numCarte',
        'typecarte',
        'montant',
        'signature',
        'id_commande',
        'nom_cmr',
        'idmsg',
        'id_apport'
    ];
}
