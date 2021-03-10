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

$search = User::where('email', $data->email)->get()->first();

if (!$search) {

$user = new User();

//TODO: Validar los datos antes de guardar el usuario

$user->name = $data->name;
$user->email = $data->email;
$user->password = Hash::make($data->password);
//$user->password = $data->password;


try{
$user->save();
return response()->json([
               
               'message' => "El usuario ha sido creado",
               'email'  => $data->email
            ]);
}catch(\Exception $e){
$response = $e->getMessage();
}

}else{

return response()->json([
               
               'message' => "403",
               'email'  => $data->email
           ]);

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

                       $randomString = Str::random(20);

                       $token = JWT::encode($randomString, $key);

                       $user->api_token = $token;

                       $user->save();

                       //$response = $token;
                     
                       return response()->json([
                          'message' => 'Bienvenido',
                          'token'  => $token,
                          'user' => $user->name
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

   public function logout(Request $request)
{
    $response = "";



    //Leer el contenido de la petición
$data = $request->getContent();

//Decodificar el json
$data = json_decode($data);

//Si hay un json válido, crear el usuario
if($data){
$data->email = $data->email;
$user = User::where('email',$data->email) -> first();

//TODO: Validar los datos antes de guardar el usuario

$user->api_token = $data->api_token;


try{
$user->api_token = "";
$user->save();
$response = "OK";
}catch(\Exception $e){
$response = $e->getMessage();
}

}


return response($response);

   
    }


   public function updatePassword(Request $request)
    {
    $response = "";


    //Leer el contenido de la petición
$data = $request->getContent();

//Decodificar el json
$data = json_decode($data);
        //$user = new User;
        if($data){
$user = User::where('email',$data->email) -> first();
        if(!Hash::check($data->currentPassword, $user->password)){

        return response()->json([
           'message' => 'Tu contraseña no coincide'
           
           
                      ]);
        }else{
   
   
        $data->email = $data->email;
        //$user1 = User::where('email',$data->email) -> first();
        $user->password = Hash::make($data->newPassword);
        //$user->newPassword = Hash::make($data->newPassword);
        //$user->newPassword = $data->newPassword;


        try{
        //$user->password = $newPassword;
$user->save();
$response = "OK";
}catch(\Exception $e){
$response = $e->getMessage();
}
   
        return response()->json([
           'message' => 'Contraseña cambiada con éxito'
         
           
                      ]);
    }}}

public function changePassword(Request $request){

        $response = "";


    //Leer el contenido de la petición
$data = $request->getContent();

//Decodificar el json
$data = json_decode($data);

if($data->email){


$user = User::where('email',$data->email) -> first();
       

        try{
        $newPassword = Str::random(10);

        $hashedPassword = Hash::make($newPassword);
           
            $user->password = $hashedPassword;

            $user->save();

            $response = "Esta es tu nueva contraseña: " . $newPassword;

        }catch(\Exception $e){
            $response = $e->getMessage();
        }
        }
        return response($response);
   
}
}