<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulateur extends Model
{
    use HasFactory;

    protected $fillable=['type', 'apport', 'durree', 'taux', 'fraisdossier', 'mensualite', 'command_id', 'client_id'];	
    
}
