<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Str;
use App\Models\api\userSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\cinema\Cinema;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    function register(Request $request, $idCinema){

        if (Cinema::find($idCinema) == null){
            return response()->json([
                'message' => 'Cinema id don\'t exist'
            ], 403);
        }

        if (userSite::where('email', $request->email)->where('cinema_id', $idCinema)->first() != null){
            return response()->json([
                'message' => 'user already exist'
            ], 403);
        }


        $usersite = userSite::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,

            'password' => Hash::make($request->password),
            'cinema_id' => $idCinema,
            'api_token' => Str::random(60),
        ]);

        return $usersite->toJson();

    }

    function login(Request $request, $idCinema){
        $usersite = userSite::where('cinema_id', $idCinema)->where('email' , $request->email)->first();
        if ($usersite == null){
            return response()->json([
                'message' => 'User not found'
            ], 403);
        } else {
            if (Hash::check($request->password, $usersite->password)){
                return $usersite->toJson();
            } else {
                return response()->json([
                    'message' => 'Password not good'
                ], 403);
            }
        }
    }

    function update(Request $request, $idCinema, $tokenUser){
        $usersite = userSite::where('api_token', $tokenUser)->first();
        if ($usersite == null){
            return response()->json([
                'message' => 'user don\t exist'
            ], 403);
        }
        
        if (userSite::where('email', $request->email)->where('cinema_id', $idCinema)->whereNot('id', $usersite->id)->first() != null){
            return response()->json([
                'message' => 'mail already exist'
            ], 403);
        }

        $usersite->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,

            'password' => Hash::make($request->password),
        ]);
        return $usersite->toJson();
    }

    function delete(Request $request, $idCinema, $tokenUser){
        $usersite = userSite::where('api_token', $tokenUser)->first();
        if ($usersite == null){
            return response()->json([
                'message' => 'user don\t exist'
            ], 403);
        }

        $usersite->delete();
    }
}
