<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GabResource extends ResourceCollection
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
            'idgab' => $this->idgab,
            'idagence' => $this->idagence,
            'agence' => $this->agency,
            'solde' => $this->solde,
            'charge' => $this->charge,
            'status' => $this->status,
            'intitule' => $this->intitule,
            'marque' => $this->marque,
            'os' => $this->os,
            'monacq' => $this->monacq,
            'misdate' => $this->misdate,
            'acdate' => $this->acdate,
            'etat' => $this->etat,
            'cam' => $this->cam == true ? '1' : '0',
            'cam_print' => $this->cam == true ? 'Oui' : 'Non',
            'adresip' => $this->adresip,
            'alerte_flag' => $this->alerte_flag == true ? '1' : '0',
            'alerte_flag_print' => $this->alerte_flag == true ? 'Oui' : 'Non'
        ];
    }
}
