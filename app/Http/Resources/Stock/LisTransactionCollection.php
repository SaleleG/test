<?php

namespace App\Http\Resources\Gabmonit;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LisTransactionCollection extends ResourceCollection
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
                    'datetransaction' => $transaction->datetransaction,
                    'cartec' => $transaction->cartec,
                    'montant' => number_format($transaction->montant,0,",","."),
                    'comission' => $transaction->comission,
                    'indexcarte' => $transaction->indexcarte,
                    'lbellecarte' => $transaction->lbellecarte,
                    'typecarte' => $transaction->typecarte,
                    'numerocarte' => $transaction->numerocarte,
                    'emv_flag' => $transaction->emv_flag,
                    'r_flag' => $transaction->r_flag,
                    'datecourte' => $transaction->datecourte,
                    'code_auto' => $transaction->code_auto,
                    'arn' => $transaction->arn,
                    'nomterminal' => $transaction->nomterminal,
                ];
            })
        ];
    }
}
