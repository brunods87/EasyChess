<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="board">
                    <div class="row" v-for="row in rows">
                        <div class="case" v-on:click="selectCase" :id="col+row" v-for="col in columns" v-bind:class="{ selected: selectedCase == col+row }">
                            <img :src="'img/'+board[col+row].image" v-if="board[col+row]">
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
                    wk: {name:'King',color:'white',image:'white_king.png', position:'E1', hasMoved:false},
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
                    bk: {name:'King',color:'black',image:'black_king.png', position:'E8', hasMoved:false}
                },
                selectedCase: '',
                selectedPiece: {},
                playerTurn: 'white',
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
                        var between = {x: current.x, y: current.y+1};
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

                    case 'Bishop': break;
                    case 'Queen': break;
                    case 'King': break;
                }
                return true;
            },
            isAvailable(dest, current, piece){
                switch(piece.name){
                    case 'Pawn': 
                        if (dest.x == current.x){
                            if (piece.hasMoved){
                                if (dest.y - current.y == 1){
                                    if(!this.board[this.getBoardCase(dest)]){
                                        return true;
                                    }
                                }
                            }else{
                                var jump = dest.y - current.y;
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
                            if (Math.abs(dest.x - current.x) == 1 && dest.y - current.y == 1){
                                if (this.capture(dest,piece)){
                                    return true;
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

                    case 'Knight': break;
                    case 'Bishop': break;
                    case 'Queen': break;
                    case 'King': break;
                }
                return false;
            },
            canMove(target, piece){
                 
                let current = this.getCoordenates(this.selectedCase);
                let dest = this.getCoordenates(target);
                if (this.isAvailable(dest, current, piece)){
                    return true;
                }
                    
                return false;
            },
            move(piece, target){
                if (this.playerTurn == piece.color){
                    if (piece && this.canMove(target,piece)){
                        this.board[target] = piece;
                        this.board[this.selectedCase] = '';
                        piece.hasMoved = true;
                        this.getGameContext(target, piece);
                        this.playerTurn = (this.playerTurn == 'white' ? 'black' : 'white');
                    }
                }
                this.selectedCase = '';
            },
            getGameContext(target, piece){

            },

            
        }
    }
</script>