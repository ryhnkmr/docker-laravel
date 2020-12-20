<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style>
        .graph {
        position: relative; /* IE is dumb */
        width: 1000px;
        background: linear-gradient(blue 40%, white);
        border-radius: 10px;
        border: 1.5px solid #ffffff;
        padding: 0px;
    }
    .graph .bar {
        display: block;
        position: relative;
        background: linear-gradient(red 40%, white);
        border-radius: 10px 0px 0px 10px;
        text-align: center;
        color: #333;
        height: 1em;
        line-height: 2em;           
    }
    .graph .bar span { position: absolute; left: 1em; }
</style>
</style>
<body>

    <div clsass="container-fuluid">
        <!-- HP表示 -->
        <div class="row">
            <div class="col-md-12" style="background:#fa5246; height:80px">
                <div class="row">
                    <div class="col-md-4 p-2">

                        <!-- player1 -->
                        <div class="player1 float-right">
                            <div class="row">
                                <div style="font-size:x-large; font-weight:bold">
                                    player1　/　
                                </div>
                                <div style="font-size:x-large; font-weight:bold">
                                <!-- 名前表示 -->
                                    名前 
                                </div>
                            </div>
                            
                            <div class="hp-gauge">
                                <!--↓ゲージに入れる値 value:現在のHPの値 max:HP最大値  -->
                                <meter
                                    min="0" max="2000"
                                    low="300" high="1000" optimum="1800"
                                    value="2000" style="width:400px; height:40px; transform: scale(-1, 1);">
                                </meter>
                            </div>

                        </div>
                     
                    </div>
                    <!-- TURN -->
                    <div class="col-md-4">
                            <div class="m-3 row ">
                                <div style="font-size: 40pt; font-weight:bold;text-align:center; margin:0 auto;">
                                TURN {{1}} <!--ターン数表示-->
                                </div>
                            </div>
                    </div>
                    
                    <!-- player2 -->
                    <div class="player2 col-md-4 p-2">
                        <div class="float-left">
                            <div class="row">
                                <div style="font-size:x-large; font-weight:bold;">
                                    player2　/　
                                </div>
                                <div style="font-size:x-large; font-weight:bold">
                                <!-- 名前表示 -->
                                    名前
                                </div>
                            </div>
                            
                            <div class="hp-gauge">
                                <!--↓ゲージに入れる値 value:現在のHPの値 max:HP最大値  -->
                                <meter
                                    min="0" max="2000"
                                    low="300" high="1000" optimum="1800"
                                    value="2000" style="width:400px; height:40px;">
                                </meter>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- body -->
<div style="background-image: url({{ asset('img/books.jpg') }});">
    <div style="height: 100%; background: rgba(255,255,255,0.5);">
        <div class="row">
            <div class="left-column col-md-3" style="background:">
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
            </div>

            <div class="main-column col-md-6" style="background-color:rgba(255,255,255,0.8);">
                <div class="battle_stage"style="width:100%; height:560px;">
                    <div>バトル画面バトル画面バトル画面バトル画面</div>
                </div>    
                    <!-- STATUS -->
                    <div class="status-column">
                        <div class="shadow bg-warning rounded mx-auto" style="width:750px; height:200px;">
                                    <h2 class="m-2" style="">STATUS</h2>
                                    <div>・テストテストテストテストテストテスト</div>
                        </div>
                    </div>
                
            </div>

            <div class="right-column col-md-3" style="background:">
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
                <div class="m-2 border border-dark mx-auto" style="width:250px; height:250px">
                <img src="https://placehold.jp/250x250.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Bet情報 -->
        <div class="row">
            <div class="col-md-12 p-2" style="background:#fa5246; height:80px">
                <div>
                <h3 style="text-align: center;">BET</h3>
                <div class="graph" style="text-align:center; margin:0 auto;">
                    <!-- BETバロメーター width:値にplayer1のBET割合を入れる -->
                    <strong class="bar" style="width: 40%;"></strong>
                </div>
                </div>
            </div>
        </div>
        
    
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
        <!-- chat.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    

</body>
</html>
