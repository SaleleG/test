<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TypePrestationCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($typeprestation){
                return [
                    'idtypeprestation' => $typeprestation->idtypeprestation,
                    'libelletypeprestation' => $typeprestation->libelletypeprestation,
                ];
            })
        ];
    }
}
