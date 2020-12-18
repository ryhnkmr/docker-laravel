<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
    <div id="player1">
      <p id="current_hp1"></p>
    </div>
    <div id="player2">
      <p id="current_hp2"></p> 
    </div>
    <button id="attack1">player1 attack</button>
    <button id="attack2">player2 attack</button>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script>
      current_hp1 = 2000;
      current_hp2 = 3000;

      battle_info = {
        round: 1,
        tern: 1,
        first: true,
        first_chara_id: 1,
        second_chara_id: 4,
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
      const hp1 = document.getElementById('current_hp1');
      hp1.innerHTML = current_hp1;
      const hp2 = document.getElementById('current_hp2');
      hp2.innerHTML = current_hp2;
      // debugger
      document.getElementById('attack1').onclick = function () {
      axios.post('/api/battle', {
        attacker_chara_id: 1,
        defender_chara_id: 4,           
      }).then(function (response) {
        console.log(response);
        // debugger
      })
      .catch(function (error) {
        console.log(error);
      });
      }


      window.Echo.channel('battle')
      .listen('AttackEvent',function(data){
        console.log(data)
        dmg = calc_attack_dmg(
          characters.filter(chara => chara.id == data['battle'].attacker_chara_id)[0].ap,
          characters.filter(chara => chara.id == data['battle'].defender_chara_id)[0].dp
        );
        debugger
        current_hp1 = calc_hp(current_hp1, dmg);
        if (dead(current_hp1)) {
          alert('dead')
        }
        
        hp1.innerHTML = current_hp1;
        
          // hp2.innerHTML = current_hp2 - data.battle.attack;
          // current_hp2 = current_hp2 - data.battle.attack; 
      });

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

    </script>
  </body>
</html>
