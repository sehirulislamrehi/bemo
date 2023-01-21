<?php

namespace App\Http\Controllers\Backend\UserModule\Board;

use App\Http\Controllers\Controller;
use App\Models\UserModule\VisitorBoard;
use Exception;
use  Spatie\DbDumper\Databases\MySql;

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


    //export_board function start
    public function export_board(){
        if( can("all_boards") ){
            try{
                $databaseName = "bemo";
                $userName = "root";
                $password = "";

                MySql::create()
                ->setDbName($databaseName)
                ->setUserName($userName)
                ->setPassword($password)
                ->includeTables(['visitor_boards'])
                ->dumpToFile('dump.sql');
                
            }
            catch( Exception $e ){
                return back()->with('error', $e->getMessage());
            }
        }
        else{
            return view("errors.403");
        }
    }
    //export_board function end
}
