<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monument;

class MonumentController extends Controller
{
    //

    public function listMonument(Request $request){
	$response = "";


    //Leer el contenido de la petición
	$data = $request->getContent();

	//Decodificar el json
	$data = json_decode($data);

	$monuments = Monument::where('name', $data->name)->first();



	return response()->json(

	[	
	"info" => $monuments->info
	]);
}
}
