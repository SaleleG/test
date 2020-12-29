<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($transaction){
                return [
                    'count' =>  number_format($this->array[0],0,",","."),
                    'amount' => number_format($this->array[1],0,",","."),
                    'idtransaction' => $transaction->idtransaction,
                    'idgab' => $transaction->idgab,
                    'gab' => $transaction->gab,
                    'lis' => $transaction->listransaction,
                    'datetransaction' => $transaction->datetransaction,
                    'cartec' => $transaction->cartec,
                    'ncp' => $transaction->ncp,
                    'responsecode' => $transaction->responsecode,
                    'montant' => number_format($transaction->montant,0,",","."),
                    'comission' => $transaction->comission,
                    'nbrecass1' => $transaction->nbrecass1,
                    'nbrecass2' => $transaction->nbrecass2,
                    'nbrecass3' => $transaction->nbrecass3,
                    'nbrecass4' => $transaction->nbrecass4,
                    'trstatus' => $transaction->trstatus,
                    'rescode' => $transaction->rescode,
                    'libellereponse' => $transaction->libellereponse,
                    'indexcarte' => $transaction->indexcarte,
                    'lbellecarte' => $transaction->lbellecarte,
                    'typecarte' => $transaction->typecarte,
                    'journal' => $transaction->journal,
                    'datechr' => $transaction->datechr,
                    'typetr' => $transaction->typetr,
                    'numerocarte' => $transaction->numerocarte,
                    'emv_flag' => $transaction->emv_flag,
                    'r_flag' => $transaction->r_flag,
                    'c_flag' => $transaction->c_flag,
                    'datecourte' => $transaction->datecourte,
                ];
            })
        ];
    }
}
