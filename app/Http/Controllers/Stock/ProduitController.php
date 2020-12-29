<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock\Type;
use App\Models\Stock\Article;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Redirect,Response,Config;

class ProduitController extends Controller
{
    public function index()
    {
        
        $data=article::select(DB::raw('count(*) as nombre,designation,quantite,seuil,emplacement,type_id'))->groupBy('designation','quantite','seuil','emplacement','type_id')->paginate(3);
         $data1=type::all();
        
      
        return view('dashboard.produit',compact('data','data1'));
    } 
}