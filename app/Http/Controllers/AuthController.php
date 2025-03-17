<?php

namespace App\Http\Controllers;

use App\Models\Societie;
use App\Models\User;
use App\Models\Validation;
use App\Models\Validator;
use Auth;
use Exception;
use Hash;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'id_card_number' => 'required',
                'password' => 'required'
            ]);
            // TODO kenapa harus menggunakan id?
            $id = $request->id_card_number % 100;
             $societies = Societie::with(relations: 'regional')->where('id_card_number' , $request->id_card_number)->first();
            if($credentials['password'] === $societies['password'])
            {
                // untuk apa data $user?
                $user = User::findOrFail($id);
                $token = Hash::make('id_card_number');

                $societies->update([
                    'login_tokens' => $token
                ]);


                $data = [
                    'name' => $societies->name,
                    'born_date' => $societies->born_date,
                    'gender' => $societies->gender,
                    'address' => $societies->address,
                    'token' => $societies->login_tokens,
                    "regional" => [
                        'id' => $societies->regional->id,
                        "province" => $societies->regional->province,
                        "district" => $societies->regional->district,
                    ]

                ];

                // return code ?
                return response()->json(['body' => $data]);
            }
            else
            {
                throw new AuthenticationException();

            }
        }
        catch(ValidationException $e)
        {
            return response()->json(['message' => $e->errors()] , 422 );
        }
        catch(ModelNotFoundException $e)
        {
            // kenapa ada exceprion model, tidak ada yang kamu throw new
            return response()->json(['message' => $e->getMessage()] , 404);
        }
        catch(AuthenticationException $e)
        {
            return response()->json(['message' => 'ID Card Number or Password incorrect'] , 401);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => $e->getMessage()] , 500);
        }
    }

    public function logout(RequeExceptionst $request)
    {
          try {
            $credentilas = $request->validate(
                [
                    'token' => 'required'
                ]
                );
                $societies = Societie::where('login_tokens' , $request->token)->first();
                if(!is_null($societies)) {
                    $societies->update([
                        'login_tokens' => ""
                    ]);
                    return response()->json(['message' => 'Logout Success'] , 200);
                }
                else {
                    // authentication exception saja
                    throw new Exception();
                }
                }
          catch(\Exception $e)
          {
            return response()->json(['message' => 'Invalid Token'] ,401);
          }


    }
}
