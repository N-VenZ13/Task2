<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login (Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'email' => 'required',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return ApiResponseHelper::error("input invalid", 400, $validator->errors());
            }
            $user = User::where('email',$request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            $data = [
                'user' => $user,
                'token' => $token
            ];
            return ApiResponseHelper::success($data, 'login success', 200);
        } catch (\Exception $e){
            return ApiResponseHelper::error('internal server error', 500,$e->getMessage());

        }
    }

    public function register(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'noHp' => 'required',
                'alamat' => 'required'
            ]);

            if($validator->fails()){
                return ApiResponseHelper::error("input invalid", 400, $validator->errors());
            }

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'noHp' => $request->noHp,
                'alamat' => $request->alamat,
                'password' => Hash::make(trim($request->password))
            ]);
            return ApiResponseHelper::success(null, 'register success', 201);
        } catch(\Exception $e){
            Log::info("Error register : ".$e->getMessage());
            return ApiResponseHelper::error('internal server error', 500,$e->getMessage());
        }
        

    }
}
