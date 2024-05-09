<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoitureResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'marque' => $this->marque,
            'modele' => $this->modele,
            'annee' => $this->annee,
        ];
    }
}
