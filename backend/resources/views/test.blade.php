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
      player_info = {
        player1: {
          id: 1,
          chara1: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: true,
          }, 
          chara2: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: false
          },
          chara3: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: false
          }
        },
        player2: {
          id: 2,
          chara1: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: false 
          }, 
          chara2: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: false
          },
          chara3: {
            hp: 2000,
            ap: 1000,
            db: 500,
            active_flg: false
          },
        }
      }
      const hp1 = document.getElementById('current_hp1');
      hp1.innerHTML = current_hp1;
      const hp2 = document.getElementById('current_hp2');
      hp2.innerHTML = current_hp2;
      
      document.getElementById('attack1').onclick = function () {
        axios.post('/api/battle', {
          attack: 2000,
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
              hp2.innerHTML = current_hp2 - data.battle.attack;
              current_hp2 = current_hp2 - data.battle.attack; 
          });

    </script>
  </body>
</html>
