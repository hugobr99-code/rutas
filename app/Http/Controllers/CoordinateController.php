<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinate;
use App\Models\Route;

class CoordinateController extends Controller
{

public function listCoordinates(Request $request){
	$response = "";


    //Leer el contenido de la petición
	$data = $request->getContent();

//Decodificar el json
	$data = json_decode($data);

	$routes = Route::where('name', $data->name)->first();

//$routesID = $routes->id->get()->first();

	$coordinate = Coordinate::where('routes_id', $routes->id)->get();
//$coordinate = Coordinate::where('routes_id',$data->routes_id)->get();


	$data = [];

	foreach ($coordinate as $a){

		$data[] = [

			"routes_id" => $a->routes_id,
			"name" => $a->name,
			"altitude" => $a->altitude,
			"latitude" => $a->latitude

		];
	}

	return $data;
}
}