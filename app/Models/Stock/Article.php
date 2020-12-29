<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //protected $table="types";  
    
    public function type()
    {
     return $this->belongsto(Type::class);
    }

    public function entrees()
    {
        return $this->hasMany(Entree::class);
    }

    public function sorties()
    {
        return $this->hasMany(Sortie::class);
    }
}
