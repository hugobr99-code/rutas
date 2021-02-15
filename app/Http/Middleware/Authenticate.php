<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Firebase\JWT\JWT;
use App\Models\User;

class Authenticate extends Middleware
{
   public function handle(Request $request, Closure $next)
    {
     //define("admin","administrator");
     $getHeaders = apache_request_headers ();
     $token = $getHeaders['Authorization'];
     $key = "hnuiklgefvauihntaerfviuhnesrvtb896IKJSHD/*-º<34NDR35";

     $decoded = JWT::decode($token, $key, array('HS256'));

$response = "";



        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);


        //primero verificamos que tiene permisos con su id de usuario
     $user = User::where('email', $data->email)->get()->first();
        if($user->api_token = $decoded){
            return $next($request, $user);
        }else{
            echo "no tienes permisos";
        abort(403, "no tiene permisos");
        }
    }
}
