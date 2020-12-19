<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script>
      current_user_id = 1;
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
        // first: {
        //   hp: 2000,
        //   chara: {
        //     id: 1,
        //     hp: 2000,
        //     ap: 1000,
        //     dp: 500,
        //     status: 0,
        //     user_id: 1,
        //   },
        // },
        // second: {
        //   hp: 3000,
        //   chara: {
        //     id: 4,
        //     hp: 2000,
        //     ap: 1000,
        //     dp: 500,
        //     status: 0,
        //     user_id: 2,
        //   }
        // },
      },

      characters = [
        {
          id: 1,
          hp: 2000,
          ap: 1000,
          dp: 500,
          status: 0,
          user_id: 1,
        }, 
        {
          id: 2,
          hp: 2000,
          ap: 1000,
          dp: 500,
          status: 0,
          user_id: 1,
        },
        {
          id: 3,
          hp: 2000,
          ap: 1000,
          dp: 500,
          status: 0,
          user_id: 1,
        },
        {
          id: 4,
          hp: 2000,
          ap: 1000,
          dp: 200,
          user_id: 2,
          status: 0
        },
        {
          id: 5,
          hp: 2000,
          ap: 1000,
          dp: 200,
          user_id: 2,
          status: 0
        },
        {
          id: 6,
          hp: 2000,
          ap: 1000,
          dp: 500,
          user_id: 2,
          status: 0
        },  
      ]
      const player1_hp = document.getElementById('player1_current_hp');
      const player2_hp = document.getElementById('player2_current_hp');

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
      player1_current_hp
      
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

      window.Echo.channel('battle')
        .listen('AttackEvent',function(data){
          console.log(data)
          // MEMO: 先攻後攻を3項演算子で判定
          attacker_info = data.battle.first_flg? player1[0] : player2[0];
          defender_info = data.battle.first_flg? player2[0] : player1[0];
          debugger
          dmg = calc_attack_dmg(
            attacker_info.chara.ap, defender_info.chara.dp
          );

          current_hp = calc_hp(defender_info.hp, dmg);
          
          after_culc_dmg(current_hp)
          
          // MEMO: hpのupdate
          defender_info.hp = current_hp;  
        });

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
      function calc_hp(current_hp, dmg_pt) {
        return current_hp - dmg_pt;
      }
      // MEMO: ⑤の判定
      function dead(current_hp) {
        return current_hp <= 0;
      }
      // MEMO: ダメージ計算後のHP判定
      function after_culc_dmg(current_hp) {
        if (dead(current_hp)) {
          // どちらのplayerが死んだか判断
          if (battle.first_flg) {
            player1.shift;
          } else {
            player2.shift
          }
        } else {
          // MEMO: ターン情報の更新
          // 後攻だったらターンプラス1
          if (!battle_info.info.first_flg) {
            battle_info.info.tern += 1
          }
          battle_info.info.first_flg = !battle_info.info.first_flg
        }
      }

      // MEMO: ラウンド終了フェイズ
      // battle_infoの保存


    </script>
  </body>
</html>
