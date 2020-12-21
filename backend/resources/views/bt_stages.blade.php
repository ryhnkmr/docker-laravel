<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle Stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style>
    .bettor-comment{
        padding: 0.5em 1em;
        font-weight: bold;
        margin: 5px;
        color: #6091d3;/*文字色*/
        background: #FFF;
        border: solid 3px #6091d3;/*線*/
        border-radius: 10px;/*角の丸み*/
    }
    .box2 p {
        margin: 0; 
        padding: 0;
    }
    /* 黒フェード */
    #fadeLayer {
        position:absolute;
        top:0px;
        left:0px;

        width:100%;
        height:100%;

        background-color:#000000;
        opacity:0.5;
        visibility:hidden;
        z-index:2;
        }

        /* 攻撃ボタン */
        .btn-square {
            display: inline-block;
            padding: 0.5em 1em;
            text-decoration: none;
            background: #668ad8;/*ボタン色*/
            color: #FFF;
            border-bottom: solid 4px #627295;
            border-radius: 3px;
            width:100px;
            height:80px;
        }
        .btn-square:active {
            /*ボタンを押したとき*/
            -webkit-transform: translateY(4px);
            transform: translateY(4px);/*下に動く*/
            border-bottom: none;/*線を消す*/
        }
        .win_result{
            position:absolute; 
            left:0px; width:50%;
            height:100%; 
            background-image: url({{ asset('img/win_anime.gif') }});
            background-size: cover;
        }
        .lose_result{
            position:absolute; 
            right:0px; width:50%; 
            height:100%; 
            background-image: url({{ asset('img/lose_anime.gif') }});
            background-size: cover;
        }

        .result_bkRGBA{
            height:100%;
            background: rgba(255,255,255,0.3);
            
        }
</style>

<body>

<figure>
    <audio
        controls
        src="'music/bgm.mp3'">
            Your browser does not support the
            <code>audio</code> element.
    </audio>
</figure>

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
                            <div class="row">
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
                    <div class="left-column col-md-2 mt-5" style="height:400px;">
                        <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                            <img src="https://placehold.jp/100x100.png" alt="">
                        </div>
                        <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                            <img src="https://placehold.jp/100x100.png" alt="">
                        </div>
                        <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                            <img src="https://placehold.jp/100x100.png" alt="">
                        </div>
                    </div>
                    
                    <!-- バトルステージ -->
                    <div class="main-column col-md-8" style="background-color:rgba(255,255,255,0.8);">
                        <div class="battle_stage"style="width:100%; height:350px;">
                            <!-- リザルト -->
                            <!-- <div class="row mx-auto ">
                                <div id="win">
                                    <div class="win_result">
                                        <div class="result_bkRGBA" class="mx-auto">
                                            <img src="{{ asset( 'img/win_400.png')}}" style="padding:120px; padding-top:160px;">
                                        </div>
                                    </div>
                                </div>      
                                <div id="lose">
                                    <div class="lose_result">
                                        <div class="result_bkRGBA" class="mx-auto">
                                            <img src="{{ asset( 'img/lose_400.png')}}" style="padding:120px; padding-top:160px;">
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <div class="row" style="text-align:center; margin:0 auto;">

                                <div class="mt-3 mx-auto " style="width:350px;height:340px;">
                                    <div id="elem"><img src="{{ asset('img/picto_img/chara1.png')}}" style="margin:25px;"></div>
                                </div>
                                
                                <div class=" mt-3 mx-auto" style="width:200px;height:340px">
                                    <h4 class="btn-square" style="margin-top: 255px; padding-left: 17px; padding-top: 20px;">Atacc!</h4>
                                </div>

                                <div class="mt-3 mx-auto" style="width:350px;height:340px">
                                    <div id="elem2"><img src="{{ asset('img/picto_img/chara2.png')}}" style="margin:25px;"></div>
                                </div>
                            

                            
                            </div>
                        </div>    
                            <!-- STATUS -->
                            <div class="status-column">
                                <div class="shadow bg-warning rounded mx-auto m-3" style="width:750px; height:150px;">
                                    <h4 class="m-2" style="">STATUS</h4>
                                    <div>・テストテストテストテストテストテスト</div>
                                </div>
                            </div>
                        
                    </div>

                        <div class="rite-column col-md-2 mt-5" style="height:400px;">
                            <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                                <img src="https://placehold.jp/100x100.png" alt="">
                            </div>
                            <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                                <img src="https://placehold.jp/100x100.png" alt="">
                            </div>
                            <div class="m-4 border border-dark mx-auto" style="width:100px; height:100px">
                                <img src="https://placehold.jp/100x100.png" alt="">
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
                                <!-- BETバロメーター width:値にplayer1のBET割合を入れる -->
                        <div class="progress bg-primary border border-white mx-auto" style="width:1000px;">
                            <div id="bet_meter" class="progress-bar bg-danger " role="progressbar"
                                style="width: 40%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- comment -->
            <div class="comment-field">
                <div class="row">
                    <div class="comment-column col-md-6" style="width:50%; height:240px;">
                        <div class="pl-5 pt-2"><h5>player1:Comments from the bettor</h5></div>
                        <div class="bettor-comment mx-auto" style="width:80%; height:180px;">
                            <p>コメント内容</p>
                        </div>
                    </div>
                    <div class="comment-column col-md-6" style="width:50%; height:240px;">
                        <div class="pl-5 pt-2"><h5>player2:Comments from the bettor</h5></div>
                        <div class="bettor-comment mx-auto" style="width:80%; height:180px;">
                            <p>コメント内容</p>
                        </div>
                    </div>
                </div>
            </div>

        <!-- 画面暗くする -->
        <a href="javascript:void(0);" onclick="fade();">黒フェード</a>
        <div id="fadeLayer"></div>



        
            
        
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- anime.jp -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>


    <script>



    // function setBalometer(){
    //     let num =40;
    //     let style = "width:" + num + "%";
    //     elt.setAttribute("style",style);
    // }

    // attac_animation.addEventListner('click', function() {
    //     player1_attack(); 
    //   })

    //   function player1_attack() {
    //     animate(
    //             targets: elem,
    //             keyframes: [
    //                 {translateX: 700},
    //                 {translateX: 600},
    //                 {translateX: 700},
    //                 {translateX: 0}
    //             ],
    //             duration: 800,
    //             easing: 'easeOutElastic(1, .8)',
    //             loop: 1

    //     )
      
    
    
    
    
    
    
    
    
    // キャラクター攻撃アニメーション
    var elem = document.getElementById('elem');
        elem.addEventListener('click',function(){
            anime({
                targets: elem,
                    keyframes: [
                        {translateX: 700},
                        {translateX: 600},
                        {translateX: 700},
                        {translateX: 0}
                     ],
                    duration: 800,
                    easing: 'easeOutElastic(1, .8)',
                    loop: 1
                })
            })

    var elem2 = document.getElementById('elem2');
        elem2.addEventListener('click',function(){
            anime({
                targets: elem2,
                    keyframes: [
                        {translateX: -700},
                        {translateX: -600},
                        {translateX: -700},
                        {translateX: 0}
                     ],
                    duration: 800,
                    easing: 'easeOutElastic(1, .8)',
                    loop: 1

                })

        })

    // 画面黒フェード
        function fade(){
            var target = document.getElementById("fadeLayer");
            target.style.visibility = "visible";
        }
    //戦闘音楽
    var bgm = new Audio();
        bgm.src = "bgm.mp3";
        bgc.play();

    </script>

</body>
</html>
