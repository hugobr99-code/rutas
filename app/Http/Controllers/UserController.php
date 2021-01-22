<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function createUser(Request $request){

    	$response = "";


    	//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el usuario
		if($data){

			$user = new User();

			//TODO: Validar los datos antes de guardar el usuario

			$user->name = $data->name;
			$user->email = $data->email;
			$user->password = Hash::make($data->password);


			try{
				$user->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

		}


		return response($response);
    }


	public function login(Request $request){
	        $response = "";

	        //Procesar los datos recibidos
	        $data = $request->getContent();

	        //Verificar que hay datos
	        $data = json_decode($data);

	        if($data){
	            
	            if(isset($data->email)&&isset($data->password)){

	                $user = User::where("email",$data->email)->first();

	                if($user){

	                    if(Hash::check($data->password, $user->password)){

	                        $key = "hnuiklgefvauihntaerfviuhnesrvtb896IKJSHD/*-º<34NDR35";

	                        $token = JWT::encode($data->email, $key);

	                        $user->api_token = $token;

	                        $user->save();

	                        $response = $token;
	                      
	                        return response()->json([
	                           'message' => 'Bienvenido'
	                       ]);

	                    }else{
	                        $response = "Contraseña incorrecta";
	                    }

	                }else{
	                    $response = "Usuario no encontrado";
	                }

	            }else{
	                $response = "Faltan datos";
	            }

	        }else{
	            $response = "Datos incorrectos";
	        }
	  
	    }
	}
