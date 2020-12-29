<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

     //protected $table="types";
    
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
