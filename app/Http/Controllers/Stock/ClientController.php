<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
   public function index()
    {
        $title = 'Gestion CLient';

      
        return view('dashboard.client',['title' => $title]);
    } 
}
