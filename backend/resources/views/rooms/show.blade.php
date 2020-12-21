  {{-- player1_hp.innerHTML = player1[0].hp;
  player2_hp.innerHTML = player2[0].hp;
  MEMO: 戦闘の流れ
  1. ラウンド準備フェイズ
      キャラ選択、その情報をbroadcastする
  2. 戦闘フェイズ(どちらかがHPがなくなるまでこのフェイズを繰り返す)
      攻撃判定のロジック
      ⓪使う数字は基本3つ。
      ・自分のAP
      ・相手のDP
      ・Dice乱数（1〜6の乱数を持たせる。サイコロを模したエフェクト）
      （attack開始時にサイコロを振るエフェクトを入れる。ゆくゆくはサイコロ＊2チャンスも追加？）
      ①まず自分のAPによるAPダメージ基礎値を計算。
      APダメージ基礎値＝(AP×2)+(AP×Dice/10)
      ②次に相手のDPによるDPダメージ基礎値を計算。
      DPダメージ基礎値＝(APダメ―ジ基礎値–DP)/2（端数切上。数字がマイナスの場合は0）
      ③最終ダメージポイントを計算。
      最終ダメージポイント＝APダメ―ジ基礎値 - DPダメージ基礎値
      ④相手のHPを削る。
      相手のlastestHP＝相手のcurrentHP - 最終ダメージポイント
      ⑤上記攻撃を1ターンごとに繰り返し、先にHPが0になった方が負け。
      攻撃を受ける 
  3. ラウンド終了フェイズ
      バトルインフォの更新、ネクストラウンドに移行 --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
  </head>
  <body>
    <!-- BGM -->
    <audio id="bgm_audio" src="{{ asset( 'music/bgm.mp3' )}}"></audio>
    <!-- SE -->
    <audio id="bgm_attack_audio" src="{{ asset( 'music/attack.mp3' )}}"></audio>
    <!-- リザルト -->
     <audio id="bgm_result_audio" src="{{ asset( 'music/result.mp3' )}}"></audio>

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
                              id="player1_hp"
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
                          <div id="display-tern" style="font-size: 40pt; font-weight:bold;text-align:center; margin:0 auto;">
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
                                id="player2_hp"
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
                    <div class="left-column col-md-2" style="height:400px; padding-top:30px; padding-right:55px;">
                        <div class="mx-auto" style="width:100px; height:100px">
                            <img id='player1-chara1' src="{{asset('img/book_open.png')}}">
                        </div>
                        <div class="mx-auto" style="width:100px; height:100px; margin:60px 0px;">
                            <img id='player1-chara2' src="{{asset('img/book_2nd.png')}}">
                        </div>
                        <div class="mx-auto" style="width:100px; height:100px">
                            <img id='player1-chara3' src="{{asset('img/book_3rd.png')}}">
                        </div>
                    </div>

                    <!-- バトルステージ -->
                    <div class="main-column col-md-8" style="background-color:rgba(255,255,255,0.8);">
                        <div class="battle_stage"style="width:100%; height:350px;">
                            <!-- リザルト -->
                            <div id='show-result' class="row mx-auto" style="display: none">
                                <div id="player1-result">
                                    <div class="win_result">
                                        <div class="result_bkRGBA" class="mx-auto">
                                            <img src="{{ asset( 'img/win_400.png')}}" style="padding:120px; padding-top:160px;">
                                        </div>
                                    </div>
                                </div>      
                                <div id="player2-result">
                                    <div class="lose_result">
                                        <div class="result_bkRGBA" class="mx-auto">
                                            <img src="{{ asset( 'img/lose_400.png')}}" style="padding:120px; padding-top:160px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                          <div class="row" style="text-align:center; margin:0 auto;">
                            <div>
                              <div hidden id="attack_icon"><img src="{{ asset('img/attack_icon.png')}}" ></div>
                            </div>

                            <div class="mt-3 mx-auto " style="width:350px;height:340px;">
                              <div id="chara1"><img src="{{ asset('img/picto_img/chara1.png')}}" style="margin:25px;"></div>
                            </div>

                            <div class=" mt-3 mx-auto" style="width:200px;height:340px">
                              <h4 id="attack" class="btn-square" style="margin-top: 255px; padding-left: 13px; padding-top: 22px;">Attack!</h4>
                            </div>

                            <div class="mt-3 mx-auto" style="width:350px;height:340px">
                              <div id="chara2"><img src="{{ asset('img/picto_img/chara2.png')}}" style="margin:25px;"></div>
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

                  <div class="left-column col-md-2" style="height:400px; padding-top:30px; padding-right:55px;">
                    <div class="mx-auto" style="width:100px; height:100px">
                      <img id='player2-chara1' src="{{asset('img/book_open.png')}}">
                    </div>
                    <div class="mx-auto" style="width:100px; height:100px; margin:60px 0px;">
                      <img id='player2-chara2' src="{{asset('img/book_2nd.png')}}">
                    </div>
                    <div class="mx-auto" style="width:100px; height:100px">
                      <img id='player2-chara3' src="{{asset('img/book_3rd.png')}}">
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
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
      const media_vol_def = function(){
        const audios=document.getElementsByTagName('audio');
        for(let n=0; audios.length>n; n++){ audios[n].volume = 0.2; }
      }
      window.addEventListener('DOMContentLoaded', function(){
        media_vol_def();
      });

      Pusher.logToConsole = false;
      current_user_id = <?php echo(Auth::user()->id) ?>;
      room_id = <?php echo($room->id) ?>;
      battle_info = {
        info: {
          tern: 1,
          first_flg: true,
        },
        player1: null,
        player2: null,
      };
      
      let pusher = new Pusher('{{ env('MIX_PUSHER_APP_KEY') }}', {
        cluster: 'ap3'
      });

      let channel = pusher.subscribe('rooms.'+ room_id);
      attack_btn = document.getElementById('attack');
      chara1 = document.getElementById('chara1');
      chara2 = document.getElementById('chara2');
      // host: player1, guest: player2

      player1_hp = document.getElementById('player1_current_hp');
      player2_hp = document.getElementById('player2_current_hp');
      
      // MEMO: ラウンド準備フェイズ
      // ToDo: キャラ選択、その情報をbroadcastする、バトルインフォのセット
      
      // MEMO: 戦闘フェイズ及びそれ関連の処理
      // 自分が先攻で先攻のターンのときか自分が後攻で後攻のターンのときボタンが押せる
      // 自分が先攻の場合
      function controll_attack_btn() {
        if (battle_info.player1[0].chara.user_id == current_user_id && battle_info.info.first_flg) { 
          attack_btn.disabled = false;
        } else if (battle_info.player2[0].chara.user_id == current_user_id && !battle_info.info.first_flg) {
          attack_btn.disabled = false;
        } else {
          attack_btn.disabled = true; 
        }
      }
      
      attack_btn.onclick = function () {
        axios.post('/api/rooms/'+ room_id + '/attack', battle_info ).then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      }

      // MEMO:player2の参加をトリガーにしてuserの情報をセットする（battle_info）
      channel.bind('App\\Events\\Player2Joined', function(data) {
        document.getElementById('bgm_audio').play();
        battle_info = {
          info: {
            tern: 1,
            first_flg: true,
          }, 
          player1: [
            {
              hp: data.player1.teams[0].characters[0].hp,
              chara: data.player1.teams[0].characters[0]
            },
            {
              hp: data.player1.teams[0].characters[1].hp,
              chara: data.player1.teams[0].characters[1]
            },
            {
              hp: data.player1.teams[0].characters[2].hp,
              chara: data.player1.teams[0].characters[2]
            },
          ],
          player2: [
            {
              hp: data.player2.teams[0].characters[0].hp,
              chara: data.player2.teams[0].characters[0]
            },
            {
              hp: data.player2.teams[0].characters[1].hp,
              chara: data.player2.teams[0].characters[1]
            },
            {
              hp: data.player2.teams[0].characters[2].hp,
              chara: data.player2.teams[0].characters[2]
            },
          ], 
        }
      })

      channel.bind('App\\Events\\AttackEvent', function(data) {
        fetch_battle_info(data.battle);
        // キャラクターが攻撃
        attack_motion();
        // MEMO: 先攻後攻を3項演算子で判定
        attacker_info = battle_info.info.first_flg? battle_info.player1[0] : battle_info.player2[0];
        defender_info = battle_info.info.first_flg? battle_info.player2[0] : battle_info.player1[0];

        // debugger
        dmg = calc_attack_dmg(
          attacker_info.chara.ap, defender_info.chara.dp
        );

        calc_hp(defender_info, dmg);
        document.getElementById('player1_hp').setAttribute('max', battle_info.player1[0].chara.hp)
        document.getElementById('player1_hp').setAttribute('value', battle_info.player1[0].hp)
        document.getElementById('player2_hp').setAttribute('max', battle_info.player2[0].chara.hp)
        document.getElementById('player2_hp').setAttribute('value', battle_info.player2[0].hp)
        check_hp_and_delete_dead_chara(defender_info);
        update_battle_info();
        check_match_result();
        document.getElementById('player1_hp').setAttribute('max', battle_info.player1[0].chara.hp)
        document.getElementById('player1_hp').setAttribute('value', battle_info.player1[0].hp)
        document.getElementById('player2_hp').setAttribute('max', battle_info.player2[0].chara.hp)
        document.getElementById('player2_hp').setAttribute('value', battle_info.player2[0].hp) 
        controll_attack_btn();
      });
      
      // MEMO: broadcastされたバトルインフォのfetch
      function fetch_battle_info(data) {
        battle_info.info = data.info;
        battle_info.player1 = data.player1;
        battle_info.player2 = data.player2;
      }

      // MEMO: 戦闘処理
      function calc_attack_dmg(ap, dp, rand_value = 1) {
        let base_attack_point = calc_attacker_basic_value(ap, rand_value);
        let base_defence_point = calc_defender_basic_value(base_attack_point, dp);
        // ③最終ダメージポイントを計算。
        return base_attack_point - base_defence_point;
      } 

      // MEMO: ①の計算式
      function calc_attacker_basic_value(ap, rand_value) {
        return (ap * 2) + (ap * rand_value / 10)
      }

      // MEMO: ②の計算式
      function calc_defender_basic_value(base_ap, dp){
        tmp_base_defence_point = (base_ap - dp) / 2
        if (tmp_base_defence_point < 0) {
          tmp_base_defence_point = 0;
        }
        return Math.ceil(tmp_base_defence_point);

      }
      // MEMO: ④の計算
      function calc_hp(defender, dmg_pt) {
        defender.hp -= dmg_pt;
      }
      // MEMO: ⑤の判定
      function dead(current_hp) {
        return current_hp <= 0;
      }

      // MEMO: ⑤の判定
      function check_hp_and_delete_dead_chara(defender_info) {
        if (defender_info.hp <= 0) {
          // どちらのplayerのキャラが死んだか判断(先攻のターンならplayer2がdead, 後攻のターンならplayer1がdead)
          if (battle_info.info.first_flg && battle_info.player2.length >= 1) {
            battle_info.player2.shift();
            if (battle_info.player2.length == 2) {
              document.getElementById('player2-chara1').src = "{{asset('img/book_1st.png')}}" 
              document.getElementById('player2-chara2').src = "{{asset('img/book_open.png')}}" 
            } else if (battle_info.player2.length == 1) {
              document.getElementById('player2-chara2').src = "{{asset('img/book_2nd.png')}}" 
              document.getElementById('player2-chara3').src = "{{asset('img/book_open.png')}}" 
            }
          } else if (!battle_info.info.first_flg && battle_info.player1.length >= 1) {
            battle_info.player1.shift();
            if (battle_info.player1.length == 2) {
              document.getElementById('player1-chara1').src = "{{asset('img/book_1st.png')}}" 
              document.getElementById('player1-chara2').src = "{{asset('img/book_open.png')}}" 
            } else if (battle_info.player1.length == 1) {
              document.getElementById('player1-chara2').src = "{{asset('img/book_2nd.png')}}" 
              document.getElementById('player1-chara3').src = "{{asset('img/book_open.png')}}" 
            }
          }
        }
      }

      // MEMO: 
      function check_match_result() {
        if(battle_info.player1.length == 0) {
          // player2: win
          document.getElementById('bgm_audio').pause();
          document.getElementById('bgm_result_audio').play();
          document.getElementById('player2-result').setAttribute('src', '{{ asset( 'img/win_400.png')}}')
          document.getElementById('player1-result').setAttribute('src', '{{ asset( 'img/lose_400.png')}}')
          document.getElementById('show-result').setAttribute('style', '')
          document.getElementById('chara1').setAttribute('style', 'display: none')
          document.getElementById('chara2').setAttribute('style', 'display: none')
        } else if (battle_info.player2.length == 0) {
          document.getElementById('bgm_audio').pause();
          document.getElementById('bgm_result_audio').play();
          document.getElementById('player1-result').setAttribute('src', '{{ asset( 'img/win_400.png')}}')
          document.getElementById('player2-result').setAttribute('src', '{{ asset( 'img/lose_400.png')}}')
          document.getElementById('show-result').setAttribute('style', '')
          document.getElementById('chara1').setAttribute('style', 'display: none')
          document.getElementById('chara2').setAttribute('style', 'display: none')
        }
      }

      function update_battle_info() {
        // MEMO: ターン情報の更新
        // 後攻だったらターンプラス1
        if (!battle_info.info.first_flg) {
          battle_info.info.tern += 1
          document.getElementById('display-tern').innerHTML = "Tern" + battle_info.info.tern;
        }
        battle_info.info.first_flg = !battle_info.info.first_flg;
      }

      function attack_motion() {
        target = battle_info.info.first_flg? chara1 : chara2;
        keyframe = battle_info.info.first_flg? 
                  [
                    {translateX: 700},
                    {translateX: 600},
                    {translateX: 700},
                    {translateX: 0}
                  ] : [
                    {translateX: -700},
                    {translateX: -600},
                    {translateX: -700},
                    {translateX: 0}
                  ];

        anime({
          targets: target,
          keyframes: keyframe,
          duration: 800,
          easing: 'easeOutElastic(1, .8)',
          loop: 1
        })
        document.getElementById('bgm_attack_audio').play()
      }
      // MEMO: ラウンド終了フェイズ
      // battle_infoの保存
    </script>
  </body>
</html>
