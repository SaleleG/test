<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 //utilisateur 
Route::get('/','Auth\LoginController@showLoginForm')->name('create-login'); 
Route::post('/','Auth\LoginController@login')->name('store-login');
Route::get('/deconnexion','Auth\LoginController@logout')->name('destroy-login');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        // Dashboard route
    Route::get('/tableau-de-bord','DashboardController@index')->name('index-dashboard');

      //gamme
     Route::get('/Types','Stock\TypeController@index')->name('index-gamme');

    Route::post('/Types','Stock\TypeController@store')->name('store-gamme');


     //produit

    Route::get('/Produit','Stock\ProduitController@index')->name('index-produit');
     
    //fournisseur

  Route::get('/Fournisseur','Stock\FournisseurController@index')->name('index-fournisseur');
     

   // client 
    
    Route::get('/CLient','Stock\ClientController@index')->name('index-client');
         });



   

        });

