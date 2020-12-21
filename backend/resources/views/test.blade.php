<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
  </head>
  <body>
    <div id="player1">
      player1
      <p id="player1_current_hp"></p>
    </div>
    <div id="player2">
      player2
      <p id="player2_current_hp"></p> 
    </div>
    <button id="attack">attack</button>
    <!-- <button id="attack2">player2 attack</button> -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
      Pusher.logToConsole = false;
      current_user_id = <?php echo(Auth::user()->id) ?>;
      
      var pusher = new Pusher('52ce419442d9e72911ab', {
        cluster: 'ap3'
      });

      var channel = pusher.subscribe('battle');
      channel.bind('App\\Events\\Battle', function(data) {
        console.log('hoge');
      });

      attack_btn = document.getElementById('attack');
      let first_chara;
      let second_chara;
      // host: player1, guest: player2
      player1 = [
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            user_id: 1,
          }, 
        },
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            status: 0,
            user_id: 1,
          }, 
        },
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            status: 0,
            user_id: 1,
          }, 
        },
      ];
      player2 = [
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            status: 0,
            user_id: 1,
          }, 
        },
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            status: 0,
            user_id: 1,
          }, 
        },
        {
          hp: 2000,
          chara: {
            id: 1,
            hp: 2000,
            ap: 1000,
            dp: 500,
            status: 0,
            user_id: 1,
          }, 
        }, 
      ];

      battle_info = {
        info: {
          tern: 1,
          first_flg: true,
        },
      },

      player1_hp = document.getElementById('player1_current_hp');
      player2_hp = document.getElementById('player2_current_hp');

      player1_hp.innerHTML = player1[0].hp;
      player2_hp.innerHTML = player2[0].hp;
      // MEMO: 戦闘の流れ
      // 1. ラウンド準備フェイズ
      //    キャラ選択、その情報をbroadcastする
      // 2. 戦闘フェイズ(どちらかがHPがなくなるまでこのフェイズを繰り返す)
      //    攻撃判定のロジック
      //    ⓪使う数字は基本3つ。
      //    ・自分のAP
      //    ・相手のDP
      //    ・Dice乱数（1〜6の乱数を持たせる。サイコロを模したエフェクト）
      //    （attack開始時にサイコロを振るエフェクトを入れる。ゆくゆくはサイコロ＊2チャンスも追加？）
      //    ①まず自分のAPによるAPダメージ基礎値を計算。
      //     APダメージ基礎値＝(AP×2)+(AP×Dice/10)
      //    ②次に相手のDPによるDPダメージ基礎値を計算。
      //     DPダメージ基礎値＝(APダメ―ジ基礎値–DP)/2（端数切上。数字がマイナスの場合は0）
      //    ③最終ダメージポイントを計算。
      //     最終ダメージポイント＝APダメ―ジ基礎値 - DPダメージ基礎値
      //    ④相手のHPを削る。
      //     相手のlastestHP＝相手のcurrentHP - 最終ダメージポイント
      //    ⑤上記攻撃を1ターンごとに繰り返し、先にHPが0になった方が負け。
      //    攻撃を受ける 
      // 3. ラウンド終了フェイズ
      //    バトルインフォの更新、ネクストラウンドに移行


      
      // MEMO: ラウンド準備フェイズ
      // ToDo: キャラ選択、その情報をbroadcastする、バトルインフォのセット
      
      // MEMO: 戦闘フェイズ及びそれ関連の処理
      // 自分が先攻で先攻のターンのときか自分が後攻で後攻のターンのときボタンが押せる
      // 自分が先攻の場合
      if (player1[0].chara.user_id == current_user_id && battle_info.info.first_flg) { 
        attack_btn.disabled = false;
      // 自分が後攻の場合
      } else if (player2[0].chara.user_id == current_user_id && !battle_info.info.first_flg) {
        attack_btn.disabled = false;
      } else {
        attack_btn.disabled = true; 
      }

      attack_btn.onclick = function () {
        axios.post('/api/battle', battle_info.info ).then(function (response) {
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      }

      channel.bind('App\\Events\\AttackEvent', function(data) {
        fetch_battle_info(data);
        // MEMO: 先攻後攻を3項演算子で判定
        attacker_info = data.battle.first_flg? player1[0] : player2[0];
        defender_info = data.battle.first_flg? player2[0] : player1[0];

        // debugger
        dmg = calc_attack_dmg(
          attacker_info.chara.ap, defender_info.chara.dp
        );

        calc_hp(defender_info, dmg);
        
        check_hp_and_delete_dead_chara(defender_info, data);
        update_battle_info();
        check_match_result();
        
        player1_hp.innerHTML = player1[0].hp;
        player2_hp.innerHTML = player2[0].hp;
      });
      
      // MEMO: broadcastされたバトルインフォのfetch
      function fetch_battle_info(data) {
        battle_info.info = data.battle;
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
      function check_hp_and_delete_dead_chara(defender_info, data) {
        if (defender_info.hp <= 0) {
          // どちらのplayerのキャラが死んだか判断(先攻のターンならplayer2がdead, 後攻のターンならplayer1がdead)
          if (data.battle.first_flg && player2.length >= 1) {
            player2.shift();
          } else if (!data.battle.first_flg && player1.length >= 1) {
            player1.shift();
          }
        }
      }

      // MEMO: 
      function check_match_result() {
        if(player1.length == 0) {
          alert('player2 win')
        } else if (player2.length == 0) {
          alert('player1 win')
        }
      }

      function update_battle_info() {
        // MEMO: ターン情報の更新
        // 後攻だったらターンプラス1
        if (!battle_info.info.first_flg) {
          battle_info.info.tern += 1
        }
        battle_info.info.first_flg = !battle_info.info.first_flg;
      }
      // MEMO: ラウンド終了フェイズ
      // battle_infoの保存
    </script>
  </body>
</html>