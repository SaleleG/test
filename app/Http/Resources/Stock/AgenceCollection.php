<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AgenceCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($agence){
                return [
                    'idagence' => $agence->idagence,
                    'idregion' => $agence->idregion,
                    'libelleagence' => $agence->libelleagence,
                    'localisation' => $agence->locatlisation,
                ];
            })
        ];
    }
}
