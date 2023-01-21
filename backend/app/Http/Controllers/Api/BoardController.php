<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModule\Visitor;
use App\Models\UserModule\VisitorBoard;
use App\Models\UserModule\VisitorBoardCard;
use Exception;
use Illuminate\Http\Request;

class BoardController extends Controller
{


    //get_board function start
    public function get_board($token){
        try{
            $visitor = Visitor::where('api_token', $token)->select("id")->first();
            if( $visitor ){ 
                $boards = VisitorBoard::where("visitor_id", $visitor->id)->orderBy("position","asc")->select("id","position","name")->with("card")->get();

                return response()->json([
                    'status' => 'success',
                    'message' => "Board list success",
                    'data' => $boards
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "No visitor found"
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
    //get_board function end


    //delete_board function start
    public function delete_board($id){
        try{

            $visitor_board = VisitorBoard::where("id",$id)->first();

            if( $visitor_board ){ 

                $visitor_board->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => "Board deleted"
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "No board found"
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
    //delete_board function end


    //create_board function start
    public function create_board(Request $request){
        try{
            $board_name = $request->board_name;
            $token = $request->token;

            if( $board_name ){
                if( $token ){
                    $visitor = Visitor::where('api_token', $token)->first();
                    if( $visitor ){
                        $visitor_board = new VisitorBoard();

                        $max_position = VisitorBoard::where("visitor_id", $visitor->id)->max("position");

                        $visitor_board->position =  $max_position + 1;
                        $visitor_board->visitor_id = $visitor->id;
                        $visitor_board->name = $board_name;
                        $visitor_board->is_active = true;

                        if( $visitor_board->save() ){

                            $boards = VisitorBoard::where("visitor_id", $visitor->id)->orderBy("position","asc")->select("id","position","name")->with("card")->where("id", $visitor_board->id)->first();

                            return response()->json([
                                'status' => 'success',
                                'message' => "New board created",
                                'data' => $boards
                            ], 200);
                        }
                    }
                    else{
                        return response()->json([
                            'status' => 'error',
                            'message' => "No visitor found"
                        ], 200);
                    }
                }
                else{
                    return response()->json([
                        'status' => 'error',
                        'message' => "No token found"
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "No board name found"
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
    //create_board function end


    //board_sorting function start
    public function board_sorting(Request $request){
        try{

            $board_ids = [];
            $position = [];
            $count = 1;
            foreach( json_decode($request->boards) as $boards ){
                array_push($board_ids, $boards->id);
                array_push($position, $count);
                $count++;
            } 

            $visitor_boards = VisitorBoard::whereIn("id", $board_ids)->get();

            foreach( json_decode($request->boards) as $key => $boards ){
                $visitor_board = $visitor_boards->where("id", $boards->id)->first();
                $visitor_board->position = $position[$key];
                $visitor_board->save();
            } 

            return response()->json([
                'status' => 'success',
                'message' => 'Sorting success'
            ], 200);

        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    } 
    //board_sorting function end


    //card_sorting function start
    public function card_sorting(Request $request){
        try{

            $card_ids = [];
            $position = [];
            $count = 1;
            foreach( json_decode($request->cards) as $cards ){
                array_push($card_ids, $cards->id);
                array_push($position, $count);
                $count++;
            } 

            $visitor_board_cards = VisitorBoardCard::whereIn("id", $card_ids)->get();

            foreach( json_decode($request->cards) as $key => $cards ){
                $visitor_board_card = $visitor_board_cards->where("id", $cards->id)->first();
                $visitor_board_card->position = $position[$key];
                $visitor_board_card->visitor_board_id = $request->item_id;
                $visitor_board_card->save();
            } 

            return response()->json([
                'status' => 'success',
                'message' => 'Sorting success'
            ], 200);

        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    } 
    //card_sorting function end


    //add_card function start
    public function add_card($id, Request $request){
        try{
            $visitor_board = VisitorBoard::where("id", $id)->select("id")->first();

            if( $visitor_board ){
                $visitor_board_card = new VisitorBoardCard();

                $max_position = VisitorBoardCard::where("visitor_board_id", $visitor_board->id)->max("position");

                $visitor_board_card->name = $request->card_name;
                $visitor_board_card->position = $max_position + 1;
                $visitor_board_card->visitor_board_id = $visitor_board->id;

                if( $visitor_board_card->save() ){
                    return response()->json([
                        'status' => 'success',
                        'message' => 'New card created',
                        'data' => $visitor_board_card
                    ], 200);
                }

            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'No board found'
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
    //add_card function end


     //delete_card function start
     public function delete_card($id){
        try{

            $visitor_board_card = VisitorBoardCard::where("id",$id)->first();

            if( $visitor_board_card ){ 

                $visitor_board_card->delete();
                return response()->json([
                    'status' => 'success',
                    'message' => "Card deleted"
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 'error',
                    'message' => "No card found"
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
    //delete_card function end


    //edit_board function start
    public function edit_board(Request $request){
        try{

        }
        catch( Exception $e ){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 200);
        }
    }
    //edit_board function end
}
