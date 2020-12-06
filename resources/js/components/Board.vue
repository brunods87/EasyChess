<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-10 text-center d-flex">
                
                <div :class="playercolor+' board'">
                    <div class="position-absolute h-100" style="left: -50px;">
                        <div class="row-count" v-for="y in rows" v-text="y">
                            
                        </div>
                    </div>
                    <div class="row" v-for="row in rows">
                        <div class="case" v-on:click="selectCase" :id="col+row" v-for="col in columns" v-bind:class="{ selected: selectedCase == col+row, inCheck: kingCheck(col+row) }">
                            <img :src="'/img/'+board[col+row].image" v-if="board[col+row]">
                        </div>
                    </div>
                    <div class="row mt-1 column-row">
                        <div class="column-count" v-for="x in columns" v-text="x">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!--Modal: modalPromotion-->
        <div class="modal fade" id="modalPromotion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-notify modal-info" role="document">
            <!--Content-->
            <div class="modal-content text-center">
              <!--Header-->
              <div class="modal-header d-flex justify-content-center">
                <p class="heading">Promote Pawn</p>
              </div>

              <!--Body-->
              <div class="modal-body text-center">

                <div class="row justify-content-center">
                    <div class="col-6 col-md-3" v-for="promo in promotionList">
                        <div class="promo" v-bind:class="{ selected: selectedPiece.name == promo.name }" @click="selectPromo(promo)">
                            <img :src="'/img/'+promo.image">
                        </div>
                    </div>
                </div>

              </div>

              <!--Footer-->
              <div class="modal-footer flex-center">
                <button @click="choosePromotion" data-dismiss="modal" class="btn btn-info">Promote</button>
              </div>
            </div>
            <!--/.Content-->
          </div>
        </div>
        <!--Modal: modalPromotion-->
    </div>
    
</template>

<script>
    export default {
        props: ['gametoken', 'playercolor'],
        mounted() {
            this.syncDown();
            var that = this;
            this.interval = setInterval(function(){
                if (that.playercolor != that.playerTurn){
                    that.syncDown();
                }
            }, 1000);
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
                selectedPiece: '',
                playerTurn: 'white',
                whiteInCheck: false,
                blackInCheck: false,
                promotionList: [],
                promotedPawn: '',
                stop: false,
                gameCheckMate: false,
                interval: null
            };
        },
        methods:{
    
            setBoard(){
                for (const value in this.pieces) {
                    let place = this.pieces[value].position;
                    this.board[place] = this.pieces[value];
                }
            },
            selectCase(event){
                if (this.selectedCase == ''){
                    this.selectedCase = event.currentTarget.id;    
                }else{
                    if(this.playercolor == this.playerTurn && event.currentTarget.id != this.selectedCase){
                        var piece = this.board[this.selectedCase];
                        if(piece && this.move(piece, event.currentTarget.id)){
                            if (piece.name == 'Pawn'){
                                if ((this.playercolor == 'white' && this.getCoordenates(piece.position).y == 8) || (this.playercolor == 'black' && this.getCoordenates(piece.position).y == 1)){
                                    this.promotePawn(piece);
                                }
                            }
                            this.getGameContext();   
                            this.playerTurn = (this.playerTurn == 'white' ? 'black' : 'white');
                            this.syncUp();
                        }    
                    }
                    this.selectedCase = '';
                }
            },
            syncUp(){
                
                axios.post('/api/syncronizeUp', {board: this.board, pieces: this.pieces, playerTurn: this.playerTurn, whiteInCheck: this.whiteInCheck, blackInCheck: this.blackInCheck, gametoken: this.gametoken, checkMate: this.gameCheckMate})
                    .then(response => {
                        this.stop = false;
                    }).catch(function (error) {
                        console.log(error);
                        alert("Erro ao sincronizar up");
                    });
            },
            syncDown(){
                if (!this.stop){
                    this.stop = true;
                    axios.post('/api/syncronizeDown', {gametoken: this.gametoken})
                        .then(response => {
                            var update = response.data;
                            this.board = update.board;
                            this.pieces = update.pieces;
                            this.playerTurn = update.playerTurn;
                            this.whiteInCheck = update.whiteInCheck;
                            this.blackInCheck = update.blackInCheck;
                            this.setBoard();
                            this.getGameContext();
                            this.stop = false;
                        }).catch(function (error) {
                            console.log(error);
                            alert("Erro ao sincronizar down");
                        });
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
                    var rollBack = this.board[target];
                    this.board[piece.position] = '';
                    var pieceDepart = piece.position; 
                    piece.position = target;
                    if (rollBack){
                        var setBack = rollBack.position;
                        rollBack.position = '';
                    }
                    this.board[target] = piece;
                    var checkSelf = false;
                    const king = this.arrayPieces.find(elem => (elem.color == piece.color && elem.name == 'King'));
                    const enemies = (piece.color == 'white' ? this.blackPieces : this.whitePieces);
                    for(const elem of enemies){
                        if (this.isAvailable(this.getCoordenates(king.position),this.getCoordenates(elem.position),elem)){
                            checkSelf = true;
                            break;
                        }
                    }
                    piece.position = pieceDepart;
                    if (rollBack){
                        rollBack.position = setBack;
                    }
                    this.board[target] = rollBack;
                    this.board[pieceDepart] = piece;
                    if (checkSelf) return false;
                    
                    return true;
                }
                    
                return false;
            },
            move(piece, target){
                if (this.playerTurn == piece.color){
                    if (piece && this.canMove(target,piece)){
                        this.stop = true;
                        this.board[piece.position] = '';
                        piece.position = target;
                        if (this.board[target]){
                            this.board[target].position = '';
                        }
                        this.board[target] = piece;
                        piece.hasMoved = true;
                        piece.color == 'white' ? this.whiteInCheck = false : this.blackInCheck = false;  
                        return true;  
                    }
                }
                return false;
            },
            getGameContext(){

                const team = (this.playercolor == 'white' ? this.whitePieces : this.blackPieces);
                const enemyKing = this.arrayPieces.find(elem => (elem.color != this.playercolor && elem.name == 'King'));
                for(const elem of team){
                    if (this.isAvailable(this.getCoordenates(enemyKing.position), this.getCoordenates(elem.position),elem)){
                        this.playercolor == 'white' ? this.blackInCheck = true : this.whiteInCheck = true;
                        break;
                    }
                }
                const enemies = (this.playercolor == 'white' ? this.blackPieces : this.whitePieces);
                const enemyInCheck = (this.playercolor == 'white' ? this.blackInCheck : this.whiteInCheck);
                if (enemyInCheck){
                    var canUncheck = false;
                    for (const soldier of enemies){
                        for(const place in this.board){
                            if (this.canMove(place, soldier)){
                                canUncheck = true;
                                break;
                            }
                        }
                        if (canUncheck) break;
                    }
                    if (!canUncheck) this.checkMate(this.playercolor);
                }
                const selfInCheck = (this.playercolor == 'white' ? this.whiteInCheck : this.blackInCheck);
                if (selfInCheck){
                    var canUncheck = false;
                    for (const soldier of team){
                        for(const place in this.board){
                            if (this.canMove(place, soldier)){
                                canUncheck = true;
                                break;
                            }
                        }
                        if (canUncheck) break;
                    }
                    if (!canUncheck) this.checkMate((this.playercolor == 'white' ? 'black' : 'white'));
                }
            },
            promotePawn(piece){

                if (piece.color == 'white'){
                    var list = [this.pieces.wq, this.pieces.wr1, this.pieces.wk1, this.pieces.wb1];
                }else{
                    var list = [this.pieces.bq, this.pieces.br1, this.pieces.bk1, this.pieces.bb1];
                }
                this.promotionList = list;
                this.promotedPawn = piece;
                $('#modalPromotion').modal('show');
            },
            selectPromo(promo){
                this.selectedPiece = promo;
            },
            choosePromotion(){
                this.promotedPawn.name = this.selectedPiece.name; 
                this.promotedPawn.image = this.selectedPiece.image;
            },
            checkMate(player){
                this.gameCheckMate = true;
                clearInterval(this.interval);
                setTimeout(function(){
                    alert(player+' wins!');
                }, 500);
            },
            kingCheck(pos){
                if (this.board[pos]){
                    if (this.board[pos].name == 'King'){
                        if (this.board[pos].color == 'white'){
                            return this.whiteInCheck;
                        }
                        if (this.board[pos].color == 'black'){
                            return this.blackInCheck;
                        }
                    }
                }
                return false;
            }
        },
        computed:{
            whitePieces(){
                var array_pieces = Object.values(this.pieces);
                var whites = array_pieces.filter(function(elem){
                    return elem.color == 'white' && elem.position != '' && elem.position != null;
                });
                return whites;
            },
            blackPieces(){
                var array_pieces = Object.values(this.pieces);
                var blacks = array_pieces.filter(function(elem){
                    return elem.color == 'black' && elem.position != '' && elem.position != null;
                });
                return blacks;
            },
            arrayPieces(){
                var array_pieces = Object.values(this.pieces);
                var currentPieces = array_pieces.filter(function(elem){
                    return elem.position ? true : false;
                });
                return currentPieces;    
            },
            
        }
    }
</script>