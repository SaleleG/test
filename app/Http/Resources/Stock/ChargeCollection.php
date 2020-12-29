<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChargeCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($charge){
                return [
                    'idgab' => $charge->idgab,
                    'cassette' => $charge->cassette,
                    'idcassette' => $charge->idcassette,
                    'chardate' => $charge->chardate,
                    'montant' => $charge->montant,
                    'nbrebillet' => $charge->nbrebillet,
                ];
            })
        ];
    }
}
