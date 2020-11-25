<?php

namespace App\Http\Controllers;

use App\Models\GameInstance;
use Illuminate\Http\Request;

class GameInstanceController extends Controller
{
    public function syncUp(Request $request)
    {
        $data = $request->post();
        $jsonBoard = json_encode($data['board']);
        $jsonPieces = json_encode($data['pieces']);
        $playerTurn = $data['playerTurn'];
        $whiteInCheck = $data['whiteInCheck'];
        $blackInCheck = $data['blackInCheck'];
        $checkMate = $data['checkMate'];
        $token = $data['gametoken'];
        $gameInstance = GameInstance::where('instanceToken', $token)->first();
        if ($gameInstance){
        	$gameInstance->board = $jsonBoard;
        	$gameInstance->pieces = $jsonPieces;
        	$gameInstance->player_turn = $playerTurn;
        	$gameInstance->white_in_check = $whiteInCheck;
        	$gameInstance->black_in_check = $blackInCheck;
        	$gameInstance->checkMate = $checkMate;
        	$gameInstance->save();
        	return true;
        }
        return false;
    }

    public function syncDown(Request $request)
    {
    	$data = $request->post();
    	$token = $data['gametoken'];
        $gameInstance = GameInstance::where('instanceToken', $token)->first();
        if ($gameInstance){
        	$board = json_decode($gameInstance->board);
        	$pieces = json_decode($gameInstance->pieces);
        	$playerTurn = $gameInstance->player_turn;
        	$whiteInCheck = $gameInstance->white_in_check;
        	$blackInCheck = $gameInstance->black_in_check;
        	$response = ['board' => $board, 'pieces' => $pieces, 'playerTurn' => $playerTurn, 'whiteInCheck' => $whiteInCheck, 'blackInCheck' => $blackInCheck];
        	return $response;
        }
    }

    public function requestGame(Request $request)
    {
        $data = $request->post();
        $token = $data['gametoken'];
        $gameInstance = GameInstance::where('instanceToken', $token)->first();
        if ($gameInstance && !is_null($gameInstance->black_player)){
        	return true;
        }
        return false;
    }
}
