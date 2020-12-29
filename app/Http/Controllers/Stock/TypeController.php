<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Stock\GammeCollection;
use App\Models\Stock\Type;
use Illuminate\Pagination\Paginator;
use Exception;
use Illuminate\Support\Facades\DB;
use Validator;

class TypeController extends Controller
{
  public function index()
    {

        $title = 'Gestion Gamme';

        $data=type::select(DB::raw('count(*) as nombre,libelle'))->groupBy('libelle')->paginate(4);

        return view('dashboard.type',compact('data','title'));
    } 

   //store 
     public function store(Request $request)
    {

 $notification = array(
  'message' => 'Gamme ajoutée avec succes', 
  'alert-type' => 'success'
    );


 $vide = array(
'message' => 'Champ obligatoire',
  'alert-type' => 'warning'
    );


    $validator = Validator::make($request->all(), [
            'libelle' => 'bail|required|between:2,25'
        ]);
 
        if ($validator->fails()) {
            return back()->with($vide);
        }

  





        $c= new type;
        $c->libelle=$request->libelle;
        $c->save() ;
         
         $data=type::select(DB::raw('count(*) as nombre,libelle'))->groupBy('libelle')->paginate(4);
          return view('dashboard.type',compact('data'))->with($notification);
      
    }


    
}
