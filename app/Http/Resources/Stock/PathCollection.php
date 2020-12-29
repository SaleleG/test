<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PathCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($path){
                return [
                    'id' => $path->id,
                    'link' => $path->link,
                    'name' => $path->name,
                    'type' => $path->type,
                    'status' => $path->status,
                    'status_print' => $path->status == 'ENABLED' ? 'Activé' : 'Désactivé',
                ];
            })
        ];
    }
}
