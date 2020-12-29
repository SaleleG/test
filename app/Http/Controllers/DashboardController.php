<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show dashboard page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $title = 'Tableau-de-bord';
        /*if(request()->wantsJson()){
            $idstatut = Statut::where('libellestatut','SERVICE')->first();
            $gabs = Gab::query();
            $gabs = $gabs->with(['solde' => function ($q){
                $q->orderBy('idcassette','asc');
            }]);
            $gabs = $gabs->with(['status' => function ($d) use ($idstatut){
                $d->wherePivot('idstatut',$idstatut->idstatut)->orderBy('date','desc');
            }]);
            $gabs = $gabs->with('agency');
            $gabs = $gabs->paginate(50);
            return new GabCollection($gabs,[0,0,0,0,0]);
        }*/
        return view('dashboard.index',[
            'title' => $title
        ]);
    }

    /**
     * Show stats.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
}
