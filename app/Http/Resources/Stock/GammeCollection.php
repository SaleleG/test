<?php

namespace App\Http\Resources\Stock;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GammeCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($gamme){
                return [
                    'libelle' => $gamme->libelle,
                ];
            })
        ];
    }
}
