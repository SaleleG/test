<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GabCollection extends ResourceCollection
{
    public $array;

    public function __construct($resource, $array)
    {
        parent::__construct($resource);
        $this->resource = $resource;
        $this->array = $array;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($gab){
                return [
                    'service' =>  $this->array[0],
                    'lowmoney' => $this->array[1],
                    'lowmoneyp' => $this->array[2],
                    'service_data' => $this->array[3],
                    'lowmoney_data' => $this->array[4],
                    'idgab' => $gab->idgab,
                    'idagence' => $gab->idagence,
                    'agence' => $gab->agency,
                    'solde' => $gab->solde,
                    'status' => $gab->status,
                    'intitule' => $gab->intitule,
                    'marque' => $gab->marque,
                    'os' => $gab->os,
                    'monacq' =>  number_format($gab->monacq,0,",","."),
                    'misdate' => $gab->misdate,
                    'acdate' => $gab->acdate,
                    'etat' => $gab->etat,
                    'cam' => $gab->cam == true ? '1' : '0',
                    'cam_print' => $gab->cam == true ? 'Oui' : 'Non',
                    'adresip' => $gab->adresip,
                    'alerte_flag' => $gab->alerte_flag == true ? '1' : '0',
                    'alerte_flag_print' => $gab->alerte_flag == true ? 'Oui' : 'Non'
                ];
            })
        ];
    }
}
