<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameInstance extends Model
{
    use HasFactory;

    public function setBoard()
    {
        $board = 
        	['A8' => '', 'B8' => '', 'C8' => '', 'D8' => '', 'E8' => '', 'F8' => '', 'G8' => '',
        	'H8' => '',
            'A7' => '', 'B7' => '', 'C7' => '', 'D7' => '', 'E7' => '', 'F7' => '', 'G7' => '',
            'H7' => '',
            'A6' => '', 'B6' => '', 'C6' => '', 'D6' => '', 'E6' => '', 'F6' => '', 'G6' => '',
            'H6' => '',
            'A5' => '', 'B5' => '', 'C5' => '', 'D5' => '', 'E5' => '', 'F5' => '', 'G5' => '',
            'H5' => '',
            'A4' => '', 'B4' => '', 'C4' => '', 'D4' => '', 'E4' => '', 'F4' => '', 'G4' => '',
            'H4' => '',
            'A3' => '', 'B3' => '', 'C3' => '', 'D3' => '', 'E3' => '', 'F3' => '', 'G3' => '',
            'H3' => '',
            'A2' => '', 'B2' => '', 'C2' => '', 'D2' => '', 'E2' => '', 'F2' => '', 'G2' => '',
            'H2' => '',
            'A1' => '', 'B1' => '', 'C1' => '', 'D1' => '', 'E1' => '', 'F1' => '', 'G1' => '',
            'H1' => ''];
        $pieces = 
        	['wp1' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'A2', 'hasMoved' => false],
            'wp2' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'B2', 'hasMoved' => false],
            'wp3' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'C2', 'hasMoved' => false],
            'wp4' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'D2', 'hasMoved' => false],
            'wp5' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'E2', 'hasMoved' => false],
            'wp6' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'F2', 'hasMoved' => false],
            'wp7' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'G2', 'hasMoved' => false],
            'wp8' => ['name' => 'Pawn','color' => 'white','image' => 'white_pawn.png', 'position' => 'H2', 'hasMoved' => false],
            'wr1' => ['name' => 'Rook','color' => 'white','image' => 'white_rook.png', 'position' => 'A1', 'hasMoved' => false],
            'wr2' => ['name' => 'Rook','color' => 'white','image' => 'white_rook.png', 'position' => 'H1', 'hasMoved' => false],
            'wk1' => ['name' => 'Knight','color' => 'white','image' => 'white_knight.png', 'position' => 'B1', 'hasMoved' => false],
            'wk2' => ['name' => 'Knight','color' => 'white','image' => 'white_knight.png', 'position' => 'G1', 'hasMoved' => false],
            'wb1' => ['name' => 'Bishop','color' => 'white','image' => 'white_bishop.png', 'position' => 'C1', 'hasMoved' => false],
            'wb2' => ['name' => 'Bishop','color' => 'white','image' => 'white_bishop.png', 'position' => 'F1', 'hasMoved' => false],
            'wq' => ['name' => 'Queen','color' => 'white','image' => 'white_queen.png', 'position' => 'D1', 'hasMoved' => false],
            'wk' => ['name' => 'King','color' => 'white','image' => 'white_king.png', 'position' => 'E1', 'hasMoved' => false, 'castle' => false],
            'bp1' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'A7', 'hasMoved' => false],
            'bp2' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'B7', 'hasMoved' => false],
            'bp3' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'C7', 'hasMoved' => false],
            'bp4' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'D7', 'hasMoved' => false],
            'bp5' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'E7', 'hasMoved' => false],
            'bp6' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'F7', 'hasMoved' => false],
            'bp7' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'G7', 'hasMoved' => false],
            'bp8' => ['name' => 'Pawn','color' => 'black','image' => 'black_pawn.png', 'position' => 'H7', 'hasMoved' => false],
            'br1' => ['name' => 'Rook','color' => 'black','image' => 'black_rook.png', 'position' => 'A8', 'hasMoved' => false],
            'br2' => ['name' => 'Rook','color' => 'black','image' => 'black_rook.png', 'position' => 'H8', 'hasMoved' => false],
            'bk1' => ['name' => 'Knight','color' => 'black','image' => 'black_knight.png', 'position' => 'B8', 'hasMoved' => false],
            'bk2' => ['name' => 'Knight','color' => 'black','image' => 'black_knight.png', 'position' => 'G8', 'hasMoved' => false],
            'bb1' => ['name' => 'Bishop','color' => 'black','image' => 'black_bishop.png', 'position' => 'C8', 'hasMoved' => false],
            'bb2' => ['name' => 'Bishop','color' => 'black','image' => 'black_bishop.png', 'position' => 'F8', 'hasMoved' => false],
            'bq' => ['name' => 'Queen','color' => 'black','image' => 'black_queen.png', 'position' => 'D8', 'hasMoved' => false],
            'bk' => ['name' => 'King','color' => 'black','image' => 'black_king.png', 'position' => 'E8', 'hasMoved' => false, 'castle' => false]
        	];
        foreach ($board as $key => $value) {
        	foreach ($pieces as $piece) {
        		if ($key == $piece['position']){
        			$board[$key] = $piece;
        		}
        	}
        }
        $this->board = json_encode($board);
        $this->pieces = json_encode($pieces);
        $this->save();
    }
}
