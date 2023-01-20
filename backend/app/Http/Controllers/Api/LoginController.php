<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Visitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    //login function start
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
    
            if( $validator->fails() ){
                return response()->json(['error' => $validator->errors()], 422);
            }
    
            $visitor = Visitor::where('email', $request->email)->first();
            
            if($visitor){
                if( Hash::check($request->password, $visitor->password) ){
                    $token = Str::random(80);
                    $visitor->api_token = $token;
                    $visitor->save();

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Login success. Click ok to redirect',
                        'data' => [
                            'token' => $token,
                            'visitor' => $visitor
                        ]
                    ], 200);
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid credential'
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credential'
                ], 200);
            }
        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    }
    //login function end

    //verification function start
    public function verification(Request $request, $token){
        try{

            if( $token ){
                $visitor = Visitor::where('api_token', $token)->first();

                if( $visitor ){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Token validation success',
                        'data' => [
                            'token' => $token,
                            'visitor' => $visitor
                        ]
                    ], 200);
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'message' => 'No visitor found'
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'No token found'
                ], 200);
            }
        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    }
    //verification function end

}
