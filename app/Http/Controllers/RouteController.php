<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Monument;
use App\Models\Coordinate;

class RouteController extends Controller
{
    //
        public function listRoute($id){

		$route = Route::find($id);

		if($route){

			return response()->json(

				[
					"id" => $route->id,
					"name" => $route->name,
					//"info" => $route->Monument->info,
					//"image" => $route->Monument->image,
					"longitude" => $route->Coordinate->coordinates->longitude,
					"latitude" => $route->Coordinate->coordinates->latitude
					
				]

			);
		}

		return response("Monumento no encontrado");
	}
}
