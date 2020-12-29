<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AlerteCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($alerte){
                return [
                    'idgab' => $alerte->idgab,
                    'idstatut' => $alerte->idstatut,
                    'date' => $alerte->date,
                    'alerte' => $alerte->alerte,
                ];
            })
        ];
    }
}
