<?php

namespace App\Http\Controllers\Backend\UserModule\Board;

use App\Http\Controllers\Controller;
use App\Models\UserModule\VisitorBoard;
use Exception;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    //index function start
    public function index(){
        if( can("all_boards") ){
            try{
                $visitor_boards = VisitorBoard::orderBy("id","desc")->with('card','visitor')->paginate(10);

                return view("backend.modules.user_module.board.index",compact('visitor_boards'));
            }
            catch( Exception $e ){
                return back()->with('error', $e->getMessage());
            }
        }
        else{
            return view("errors.403");
        }
    }
    //index function end
}
