<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrestationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($prestation){
                return [
                    'idprestation' => $prestation->idprestation,
                    'gab' => $prestation->gab,
                    'date' => $prestation->date,
                    'prestataire' => $prestation->prestataire,
                    'description' => $prestation->description,
                    'montant' => $prestation->montant,
                ];
            })
        ];
    }
}
