<?php

namespace App\Http\Controllers\Backend\UserModule\Visitor;

use App\Http\Controllers\Controller;
use App\Models\ProductModule\Product;
use App\Models\UserModule\Visitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;


class Visitorcontroller extends Controller
{
    //idnex function start
    public function index(Request $request){
        if( can("visitor") ){
            $result = '';

            $query = Visitor::orderBy("id","desc")->select("id","name","email","created_at");

            if( $request->search ){
                $result = $request->search;
                $visitors = $query->where("name","LIKE","%$result%")
                                ->orWhere("email","LIKE","%$result%")
                                ->paginate(10);
            }
            else{
                $visitors = $query->paginate(10);
            }
            

            return view("backend.modules.user_module.visitor.index", compact('visitors'));
        }
        else{
            return view("errors.403");
        }
    }
    //idnex function end



    //reset_password_modal function start
    public function reset_password_modal($id){
        if( can('reset_password_visitor') ){
            $visitor = Visitor::where("id",decrypt($id))->select("id","email")->first();

            if( $visitor ){
                return view("backend.modules.user_module.visitor.modals.reset",compact('visitor'));
            }
            else{
                return response()->json(['warning' => 'No visitor found' ], 200);
            }

        }
        else{
            return response()->json(['warning' => unauthorized() ], 200);
        }
    } 
    //reset_password_modal function end


    //reset password function start
    public function reset_password(Request $request, $id)
    {
        if( can('reset_password_visitor') ){
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:6',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } 
            else {
    
                $visitor = Visitor::where("id",decrypt($id))->first();
                $visitor->password = Hash::make($request->password);
    
                if ($visitor->save()) {
                    return response()->json(['success' => 'Password Reset'], 200);
                }
               
            }
        }
        else{
            return response()->json(['warning' => unauthorized() ], 200);
        }
        
    }
    //reset password function end


    //view function start
    public function view($id){
        if( can('visitor') ){
            $visitor = Visitor::where("id",decrypt($id))->first();

            if( $visitor ){
                return view("backend.modules.user_module.visitor.modals.view",compact('visitor'));
            }
            else{
                return response()->json(['warning' => 'No visitor found' ], 200);
            }
        }
        else{
            return response()->json(['warning' => unauthorized() ], 200);
        }
    }
    //view function end


    //delete_visitor function start
    public function delete_visitor(Request $request){
        try{
            if( $request->visitor_ids ){

                Visitor::whereIn("id",$request->visitor_ids)->delete();

                return back()->with('success','Selected visitors deleted');
            }
            else{
                return back()->with('warning','Please Selected an item');
            }
            
        }
        catch( Exception $e ){
            return back()->with('warning', $e->getMessage());
        }
    }
    //delete_visitor function end

}
