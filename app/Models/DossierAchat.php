<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierAchat extends Model
{
    use HasFactory;

    protected $fillable = ['modepaiement',
                            'modepaiement_Validation',
                            'cin',
                            'cin_Validation',
                            'Attestationsalaire',
                            'Attestationsalaire_Validation',
                            'bulletinpaie',
                            'bulletinpaie_Validation',
                            'relevebancaire',
                            'relevebancaire_Validation',
                            'justificatifdomiciliation',
                            'justificatifdomiciliation_Validation',
                            'rib',
                            'rib_Validation',
                            'relevecnss',
                            'relevecnss_Validation',
                            'client_id',
                            'RCIcomment',
                            'commande_id',
                            'client_id'
                        ];
                        

}
