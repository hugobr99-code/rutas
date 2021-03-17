<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Circle;

class CircleController extends Controller
{
    //
        public function listCircle(Request $request){

        $response = "";

   		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);


		$circle = Circle::where('id', $data->id)->get();

		$data = [];

		foreach ($circle as $a){
			
			$data[] = [

					"longitudeC" => $a->longitudeC,
					"longitudeG" => $a->longitudeG,
					"latitudeC" => $a->latitudeC,
					"latitudeG" => $a->latitudeG,
					"radiusC" => $a->radiusC,
					"radiusG" => $a->radiusG
				];

			
		}

		return $data;
	}
}
