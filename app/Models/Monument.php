<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monument extends Model
{
    use HasFactory;
     public function routes(){
    	return $this->belongsToOne(Route::class);
    }
   
}
