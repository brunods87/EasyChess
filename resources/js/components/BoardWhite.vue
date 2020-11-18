<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-10 text-center d-flex">
                
                <div class="board">
                    <div class="position-absolute h-100" style="left: -50px;">
                        <div class="row-count" v-for="y in rows" v-text="y">
                            
                        </div>
                    </div>
                    <div class="row" v-for="row in rows">
                        <div class="case" v-on:click="selectCase" :id="col+row" v-for="col in columns" v-bind:class="{ selected: selectedCase == col+row }">
                            <img :src="'img/'+board[col+row].image" v-if="board[col+row]">
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="column-count" v-for="x in columns" v-text="x">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            for (const [key, value] of Object.entries(this.pieces)) {
                let place = value.position;
                let img = '<img src="img/'+value.image+'">';
                this.board[place] = value;
            }

        },
        data(){
            return {
                columns: ['A','B','C','D','E','F','G','H'],
                rows: [8,7,6,5,4,3,2,1],
                board: {
                    A8: '', B8: '', C8: '', D8: '', E8: '', F8: '', G8: '', H8: '',
                    A7: '', B7: '', C7: '', D7: '', E7: '', F7: '', G7: '', H7: '',
                    A6: '', B6: '', C6: '', D6: '', E6: '', F6: '', G6: '', H6: '',
                    A5: '', B5: '', C5: '', D5: '', E5: '', F5: '', G5: '', H5: '',
                    A4: '', B4: '', C4: '', D4: '', E4: '', F4: '', G4: '', H4: '',
                    A3: '', B3: '', C3: '', D3: '', E3: '', F3: '', G3: '', H3: '',
                    A2: '', B2: '', C2: '', D2: '', E2: '', F2: '', G2: '', H2: '',
                    A1: '', B1: '', C1: '', D1: '', E1: '', F1: '', G1: '', H1: '',
                },
                pieces: {
                    wp1: {name:'Pawn',color:'white',image:'white_pawn.png', position:'A2', hasMoved:false},
                    wp2: {name:'Pawn',color:'white',image:'white_pawn.png', position:'B2', hasMoved:false},
                    wp3: {name:'Pawn',color:'white',image:'white_pawn.png', position:'C2', hasMoved:false},
                    wp4: {name:'Pawn',color:'white',image:'white_pawn.png', position:'D2', hasMoved:false},
                    wp5: {name:'Pawn',color:'white',image:'white_pawn.png', position:'E2', hasMoved:false},
                    wp6: {name:'Pawn',color:'white',image:'white_pawn.png', position:'F2', hasMoved:false},
                    wp7: {name:'Pawn',color:'white',image:'white_pawn.png', position:'G2', hasMoved:false},
                    wp8: {name:'Pawn',color:'white',image:'white_pawn.png', position:'H2', hasMoved:false},
                    wr1: {name:'Rook',color:'white',image:'white_rook.png', position:'A1', hasMoved:false},
                    wr2: {name:'Rook',color:'white',image:'white_rook.png', position:'H1', hasMoved:false},
                    wk1: {name:'Knight',color:'white',image:'white_knight.png', position:'B1', hasMoved:false},
                    wk2: {name:'Knight',color:'white',image:'white_knight.png', position:'G1', hasMoved:false},
                    wb1: {name:'Bishop',color:'white',image:'white_bishop.png', position:'C1', hasMoved:false},
                    wb2: {name:'Bishop',color:'white',image:'white_bishop.png', position:'F1', hasMoved:false},
                    wq: {name:'Queen',color:'white',image:'white_queen.png', position:'D1', hasMoved:false},
                    wk: {name:'King',color:'white',image:'white_king.png', position:'E1', hasMoved:false, castle:false},
                    bp1: {name:'Pawn',color:'black',image:'black_pawn.png', position:'A7', hasMoved:false},
                    bp2: {name:'Pawn',color:'black',image:'black_pawn.png', position:'B7', hasMoved:false},
                    bp3: {name:'Pawn',color:'black',image:'black_pawn.png', position:'C7', hasMoved:false},
                    bp4: {name:'Pawn',color:'black',image:'black_pawn.png', position:'D7', hasMoved:false},
                    bp5: {name:'Pawn',color:'black',image:'black_pawn.png', position:'E7', hasMoved:false},
                    bp6: {name:'Pawn',color:'black',image:'black_pawn.png', position:'F7', hasMoved:false},
                    bp7: {name:'Pawn',color:'black',image:'black_pawn.png', position:'G7', hasMoved:false},
                    bp8: {name:'Pawn',color:'black',image:'black_pawn.png', position:'H7', hasMoved:false},
                    br1: {name:'Rook',color:'black',image:'black_rook.png', position:'A8', hasMoved:false},
                    br2: {name:'Rook',color:'black',image:'black_rook.png', position:'H8', hasMoved:false},
                    bk1: {name:'Knight',color:'black',image:'black_knight.png', position:'B8', hasMoved:false},
                    bk2: {name:'Knight',color:'black',image:'black_knight.png', position:'G8', hasMoved:false},
                    bb1: {name:'Bishop',color:'black',image:'black_bishop.png', position:'C8', hasMoved:false},
                    bb2: {name:'Bishop',color:'black',image:'black_bishop.png', position:'F8', hasMoved:false},
                    bq: {name:'Queen',color:'black',image:'black_queen.png', position:'D8', hasMoved:false},
                    bk: {name:'King',color:'black',image:'black_king.png', position:'E8', hasMoved:false, castle:false}
                },
                selectedCase: '',
                selectedPiece: {},
                playerTurn: 'white',
                whiteInCheck: false,
                blackInCheck: false
            };
        },
        methods:{

            selectCase(event){
                if (this.selectedCase == ''){
                    this.selectedCase = event.currentTarget.id;    
                }else{
                    if (event.currentTarget.id == this.selectedCase){
                        this.selectedCase = '';
                    }else{
                        const piece = this.board[this.selectedCase];
                        this.move(piece, event.currentTarget.id);    
                    }
                }
            },
            getCoordenates(position){
                let x = position.substring(0,1);
                x = this.columns.indexOf(x);
                let y = position.substring(1,2);
                return {x: Number(x), y: Number(y)};
            },
            getBoardCase(coordenates){
                let col = this.columns[coordenates.x];
                let row = coordenates.y;
                return col+row;
            },
            capture(dest,piece){
                const occupied = this.board[this.getBoardCase(dest)];
                if (occupied && occupied.color != piece.color){
                    return true;
                }
                return false;
            },
            pathCleared(current,dest,piece){

                switch(piece.name){
                    case 'Pawn': 
                        if (piece.color == 'white'){
                            var between = {x: current.x, y: current.y+1};
                        }else{
                            var between = {x: current.x, y: current.y-1};
                        }
                        if (this.board[this.getBoardCase(between)]){
                            return false;
                        }
                    break;
                    case 'Rook': 
                        if (dest.x == current.x){
                            if (dest.y > current.y){
                                for (let i = current.y+1;i < dest.y;i++){
                                    if (this.board[this.getBoardCase({x:current.x,y:i})]){
                                        return false;
                                    }
                                }
                            }else{
                                for (let i = current.y-1;i > dest.y;i--){
                                    if (this.board[this.getBoardCase({x:current.x,y:i})]){
                                        return false;
                                    }
                                }
                            }    
                        }else{
                            if (dest.x > current.x){
                                for (let i = current.x+1;i < dest.x;i++){
                                    if (this.board[this.getBoardCase({x:i,y:current.y})]){
                                        return false;
                                    }
                                }
                            }else{
                                for (let i = current.x-1;i > dest.x;i--){
                                    if (this.board[this.getBoardCase({x:i,y:current.y})]){
                                        return false;
                                    }
                                }
                            }  
                        }

                    break;
            
                    case 'Knight':
                    break;

                    case 'Bishop':
                        if (dest.y > current.y && dest.x > current.x){
                            for (let i = current.y+1, j = current.x+1;i < dest.y;i++,j++){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y > current.y && dest.x < current.x){
                            for (let i = current.y+1, j = current.x-1;i < dest.y;i++,j--){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y < current.y && dest.x > current.x){
                            for (let i = current.y-1, j = current.x+1;i > dest.y;i--,j++){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y < current.y && dest.x < current.x){
                            for (let i = current.y-1, j = current.x-1;i > dest.y;i--,j--){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }
                    break;

                    case 'Queen': 
                        if (dest.x == current.x){
                            if (dest.y > current.y){
                                for (let i = current.y+1;i < dest.y;i++){
                                    if (this.board[this.getBoardCase({x:current.x,y:i})]){
                                        return false;
                                    }
                                }
                            }else{
                                for (let i = current.y-1;i > dest.y;i--){
                                    if (this.board[this.getBoardCase({x:current.x,y:i})]){
                                        return false;
                                    }
                                }
                            }    
                        }else if (dest.y == current.y){
                            if (dest.x > current.x){
                                for (let i = current.x+1;i < dest.x;i++){
                                    if (this.board[this.getBoardCase({x:i,y:current.y})]){
                                        return false;
                                    }
                                }
                            }else{
                                for (let i = current.x-1;i > dest.x;i--){
                                    if (this.board[this.getBoardCase({x:i,y:current.y})]){
                                        return false;
                                    }
                                }
                            }  
                        }else if (dest.y > current.y && dest.x > current.x){
                            for (let i = current.y+1, j = current.x+1;i < dest.y;i++,j++){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y > current.y && dest.x < current.x){
                            for (let i = current.y+1, j = current.x-1;i < dest.y;i++,j--){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y < current.y && dest.x > current.x){
                            for (let i = current.y-1, j = current.x+1;i > dest.y;i--,j++){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }else if (dest.y < current.y && dest.x < current.x){
                            for (let i = current.y-1, j = current.x-1;i > dest.y;i--,j--){
                                if (this.board[this.getBoardCase({x:j,y:i})]){
                                    return false;
                                }
                            }
                        }
                    break;

                    case 'King': 
                        if (piece.color == 'white'){
                            var enemies = this.blackPieces;
                            if (dest.x == 6){
                                var rook = this.pieces.wr2;
                                if (rook.hasMoved) return false;
                                for(let i = current.x + 1;i < this.getCoordenates(rook.position).x;i++){
                                    if (this.board[this.getBoardCase({x:i,y:1})]){
                                        return false;
                                    }
                                }
                                for(const elem of enemies){
                                    if (this.canMove('F1',elem) || this.canMove('G1',elem)){
                                        return false;
                                    }
                                }
                                this.board[rook.position] = '';
                                rook.position = 'F1';
                                rook.hasMoved = true;
                                this.board.F1 = rook;
                            }else if (dest.x == 2) {
                                var rook = this.pieces.wr1;
                                if (rook.hasMoved) return false;
                                for(let i = current.x - 1;i > this.getCoordenates(rook.position).x;i--){
                                    if (this.board[this.getBoardCase({x:i,y:1})]){
                                        return false;
                                    }
                                }
                                for(const elem of enemies){
                                    if (this.canMove('D1',elem) || this.canMove('C1',elem)){
                                        return false;
                                    }
                                }
                                this.board[rook.position] = '';
                                rook.position = 'D1';
                                rook.hasMoved = true;
                                this.board.D1 = rook;
                            } 
                        }else{
                            var enemies = this.whitePieces;
                            if (dest.x == 6){
                                var rook = this.pieces.br2;
                                if (rook.hasMoved) return false;
                                for(let i = current.x + 1;i < this.getCoordenates(rook.position).x;i++){
                                    if (this.board[this.getBoardCase({x:i,y:8})]){
                                        return false;
                                    }
                                }
                                for(const elem of enemies){
                                    if (this.canMove('F8',elem) || this.canMove('G8',elem)){
                                        return false;
                                    }
                                }
                                this.board[rook.position] = '';
                                rook.position = 'F8';
                                rook.hasMoved = true;
                                this.board.F8 = rook;
                            }else if (dest.x == 2) {
                                var rook = this.pieces.br1;
                                if (rook.hasMoved) return false;
                                for(let i = current.x - 1;i > this.getCoordenates(rook.position).x;i--){
                                    if (this.board[this.getBoardCase({x:i,y:8})]){
                                        return false;
                                    }
                                }
                                for(const elem of enemies){
                                    if (this.canMove('D8',elem) || this.canMove('C8',elem)){
                                        return false;
                                    }
                                }
                                this.board[rook.position] = '';
                                rook.position = 'D8';
                                rook.hasMoved = true;
                                this.board.D8 = rook;
                            } 
                        }
                    break;
                }
                return true;
            },
            isAvailable(dest, current, piece){
                switch(piece.name){
                    case 'Pawn': 
                        if (dest.x == current.x){
                            if (piece.hasMoved){
                                if ((dest.y - current.y == 1 && piece.color == 'white') || (current.y - dest.y == 1 && piece.color == 'black')){
                                    if(!this.board[this.getBoardCase(dest)]){
                                        return true;
                                    }
                                }
                            }else{
                                var jump = Math.abs(dest.y - current.y);
                                if (jump == 1 || jump == 2){
                                    if (jump == 2 && !this.pathCleared(current,dest,piece)){
                                        return false;
                                    }
                                    if(!this.board[this.getBoardCase(dest)]){
                                        return true;
                                    }
                                }
                            }
                        }else{
                            if (piece.color == 'white'){
                                if (Math.abs(dest.x - current.x) == 1 && dest.y - current.y == 1){
                                    if (this.capture(dest,piece)){
                                        return true;
                                    }
                                }
                            }else{
                                if (Math.abs(dest.x - current.x) == 1 && current.y - dest.y == 1){
                                    if (this.capture(dest,piece)){
                                        return true;
                                    }
                                }
                            }
                        }

                    break;

                    case 'Rook': 
                        if (dest.x == current.x || dest.y == current.y){
                            if (this.pathCleared(current,dest,piece)){
                                if(!this.board[this.getBoardCase(dest)]){
                                    return true;
                                }
                                if (this.capture(dest,piece)){
                                    return true;
                                }
                            }
                        }

                    break;

                    case 'Knight': 
                        if ((Math.abs(dest.x - current.x) == 1 && Math.abs(dest.y - current.y) == 2) || (Math.abs(dest.x - current.x) == 2 && Math.abs(dest.y - current.y) == 1)){
                            if(!this.board[this.getBoardCase(dest)]){
                                return true;
                            }
                            if (this.capture(dest,piece)){
                                return true;
                            }
                        }
                    break;

                    case 'Bishop': 
                        if (Math.abs(dest.x - current.x) == Math.abs(dest.y - current.y)){
                            if (this.pathCleared(current,dest,piece)){
                                if(!this.board[this.getBoardCase(dest)]){
                                    return true;
                                }
                                if (this.capture(dest,piece)){
                                    return true;
                                }
                            }
                        }
                    break;

                    case 'Queen':
                        if ((Math.abs(dest.x - current.x) == Math.abs(dest.y - current.y)) || (dest.x == current.x || dest.y == current.y)){
                            if (this.pathCleared(current,dest,piece)){
                                if(!this.board[this.getBoardCase(dest)]){
                                    return true;
                                }
                                if (this.capture(dest,piece)){
                                    return true;
                                }
                            }
                        }
                    break;

                    case 'King':
                        if ((dest.x == current.x && Math.abs(dest.y - current.y) == 1) || (dest.y == current.y && Math.abs(dest.x - current.x) == 1) || (Math.abs(dest.x - current.x) == Math.abs(dest.y - current.y) && Math.abs(dest.x - current.x) == 1)){
                            if(!this.board[this.getBoardCase(dest)]){
                                return true;
                            }
                            if (this.capture(dest,piece)){
                                return true;
                            }
                        }
                        if (piece.color == 'white'){
                            if (!piece.hasMoved && !this.whiteInCheck){
                                if (Math.abs(dest.x - current.x) == 2 && dest.y == current.y && this.pathCleared(current,dest,piece)){
                                    return true;
                                }
                            }
                        }else{
                            if (!piece.hasMoved && !this.blackInCheck){
                                if (Math.abs(dest.x - current.x) == 2 && dest.y == current.y && this.pathCleared(current,dest,piece)){
                                    return true;
                                }
                            }
                        }
                    break;
                }
                return false;
            },
            canMove(target, piece){
                 
                let current = this.getCoordenates(piece.position);
                let dest = this.getCoordenates(target);
                if (this.isAvailable(dest, current, piece)){
                    return true;
                }
                    
                return false;
            },
            move(piece, target){
                if (this.playerTurn == piece.color){
                    if (piece && this.canMove(target,piece)){
                        var rollBack = this.board[target];
                        this.board[piece.position] = '';
                        piece.position = target;
                        if (this.board[target]){
                            var setBack = this.board[target].position;
                            this.board[target].position = '';
                        }
                        this.board[target] = piece;
                        if(this.getGameContext(piece)){
                            piece.hasMoved = true;
                            this.playerTurn = (this.playerTurn == 'white' ? 'black' : 'white');    
                        }else{
                            piece.position = this.selectedCase;
                            if (rollBack){
                                rollBack.position = setBack;
                            }
                            this.board[target] = rollBack;
                            this.board[this.selectedCase] = piece;
                        }
                    }
                }
                this.selectedCase = '';
            },
            getGameContext(piece){

                const king = this.arrayPieces.find(elem => (elem.color == piece.color && elem.name == 'King'));
                const enemies = (piece.color == 'white' ? this.blackPieces : this.whitePieces);
                
                for(const elem of enemies){
                    if (this.canMove(king.position,elem)){
                        return false;
                    }
                }
                piece.color == 'white' ? this.whiteInCheck = false : this.blackInCheck = false;

                const team = (piece.color == 'white' ? this.whitePieces : this.blackPieces);
                const enemyKing = this.arrayPieces.find(elem => (elem.color != piece.color && elem.name == 'King'));
                for(const elem of team){
                    if (this.canMove(enemyKing.position,elem)){
                        piece.color == 'white' ? this.blackInCheck = true : this.whiteInCheck = true;
                    }
                }
                return true;
            },

            
        },
        computed:{
            whitePieces(){
                var array_pieces = Object.values(this.pieces);
                var whites = array_pieces.filter(function(elem){
                    return elem.color == 'white' && elem.position != '';
                });
                return whites;
            },
            blackPieces(){
                var array_pieces = Object.values(this.pieces);
                var blacks = array_pieces.filter(function(elem){
                    return elem.color == 'black' && elem.position != '';
                });
                return blacks;
            },
            arrayPieces(){
                var array_pieces = Object.values(this.pieces);
                var currentPieces = array_pieces.filter(function(elem){
                    return elem.position != '';
                });
                return currentPieces;    
            }
        }
    }
</script>