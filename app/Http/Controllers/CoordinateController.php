<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordinate;

class CoordinateController extends Controller
{
    //
    /*public function listCoordinates(Request $request,$routes_id){

    	

		$coordinate = Coordinate::where('routes_id',$routes_id)->get()->first();
		
		$Routes_id = $coordinate->routes_id;


		if($coordinate){

			return response()->json(

				[
					"routes_id" => $Routes_id,
					"altitude" => $coordinate->altitude,
					"latitude" => $coordinate->latitude
					
				]

			);
		}

		return response("Coordenada no encontrada");
	}*/

	public function listCoordinates(Request $request){
		$response = "";


    	//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);
		
		$coordinate = Coordinate::where('routes_id',$data->routes_id)->get();
			

			$data = [];

			foreach ($coordinate as $a){
				
				$data[] =	[

					"routes_id" => $a->routes_id,
					"altitude" => $a->altitude,
					"latitude" => $a->latitude

				];
		}

		return $data;
	}
}
