<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandeEquipement extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'equipement_id'];
}