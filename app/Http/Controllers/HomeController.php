<?php

namespace App\Http\Controllers;

use App\Models\GameInstance;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($token = null)
    {
        $user = Auth::user();
        if (!is_null($token)){
            $gameInstance = GameInstance::where('instanceToken', $token)->first();
            if ($gameInstance){
                if ($user->id == $gameInstance->white_player){
                    $playerColor = 'white';
                }else if($user->id == $gameInstance->black_player){
                    $playerColor = 'black';
                }
                return view('home', compact('token', 'playerColor'));
            }
        }
        $gameInstance = GameInstance::where('white_player', '!=', null)->where('black_player', null)->first();
        if ($gameInstance){
            $token = $gameInstance->instanceToken;
            if ($gameInstance->white_player != $user->id){
                $gameInstance->black_player = $user->id;
                $gameInstance->save();
                $gameInstance->setBoard();
                return redirect(route('home', ['token' => $token]));
            }else{
                return view('limbo', compact('token'));
            }
        }else{
            $gameInstance = new GameInstance();
            $gameInstance->white_player = $user->id;
            $gameInstance->instanceToken = uniqid();
            $gameInstance->save();
            $token = $gameInstance->instanceToken;
            return view('limbo', compact('token'));
        }
        
    }
}
