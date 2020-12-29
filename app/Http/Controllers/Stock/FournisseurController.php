<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
class FournisseurController extends Controller
{
    public function index()
    {
        $title = 'Gestion Fournisseur';

      
        return view('dashboard.fournisseur',['title' => $title]);
    } 
}
