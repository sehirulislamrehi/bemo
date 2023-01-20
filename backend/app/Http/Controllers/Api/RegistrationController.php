<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Visitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    
    public function registration(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:visitors,email',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
            ]);
            if( $validator->fails() ){
                return response()->json(['error' => $validator->errors()], 422);
            }

            $visitor = new Visitor();
            $visitor->name = $request->name;
            $visitor->email = $request->email;
            $visitor->password = Hash::make($request->password);

            if( $visitor->save() ){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Registration successfully done',
                    'data' => $visitor
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

}
