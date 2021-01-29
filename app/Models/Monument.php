<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monument extends Model
{
    use HasFactory;
     public function routes(){
    	return $this->belongsToMany(Route::class);
    }
    public function coordinates(){
    	return $this->hasOne(Monument::class);
    }
}
