<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Document</title>
</head>
<body>

<p id='content1'></p>
<p id='content2'></p>
<p id='content3'></p>
<p id='content4'></p>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://assets.what3words.com/sdk/v3/what3words.js?key=Z9Y6EOLM"></script>

<script>
function culc_rand_num(min, max) { //ランダム生成の関数
  return Math.floor(Math.random() * (max - min + 1) + min);
}

const hiraToKana = text =>{ //かな→カナ変換の関数
  return text.replace( /[\u3042-\u3093]/g, 
    m => String.fromCharCode(m.charCodeAt(0) + 96)
  );
};

let isbn_s         = '9784492532706'; //★ここに楽天APIの「isbn」を入れる
let booksGenreId_s = '1006018002';    //★ここに楽天APIの「booksGenreId」を入れる
let isbn           = Number(isbn_s);
let booksGenreId   = Number(booksGenreId_s);
let base_plus      = isbn + booksGenreId;
let base_minus     = isbn - booksGenreId;
let rand_lon       = culc_rand_num(base_minus, base_plus);
let rand_lat       = culc_rand_num(base_minus, base_plus);
let result1        = String(rand_lon);
let result2        = String(rand_lat);
let res1           = result1.slice(-3);
let res2           = result2.slice(-3);
const longitude    = res1;
const latitude     = res2;
const baseURL      = 'https://api.what3words.com/v3/convert-to-3wa?key=Z9Y6EOLM'
let word           = '';
axios.get(baseURL+'&coordinates=35.669' + latitude + ',139.703' + longitude + '&language=ja&format=json')
.then(function (response) {
  console.log(response);
  let words     = response.data.words;
  word          = words.split('・'); //指定した区切りで分割して配列に格納
  let nameParts = word[0];
  let attribute = word[1];
  let codeName  = hiraToKana(word[2]);
  let pub       = '角川'; //★ここに楽天APIの「publisherName」を入れる
  let plus      = '';
  if (pub.indexOf('角川') != -1) {
    plus = 'KADOKAWA';
  } else if(pub.indexOf('KADOKAWA') != -1) {
    plus = 'KADOKAWA';
  } else if(pub.indexOf('岩波') != -1) {
    plus = 'ロック＆ウェーブ書店';
  } else if (pub.indexOf('学研') != -1) {
    plus = '学研';
  } else if (pub.indexOf('幻冬舎') != -1) {
    plus = '幻冬舎';
  } else if (pub.indexOf('光文社') != -1) {
    plus = '光文杜';
  } else if (pub.indexOf('講談') != -1) {
    plus = '講談杜';
  } else if (pub.indexOf('集英') != -1) {
    plus = 'ジャンプ杜';
  } else if (pub.indexOf('新潮') != -1) {
    plus = '新潮杜';
  } else if (pub.indexOf('小学館') != -1) {
    plus = 'Small学館';
  } else if (pub.indexOf('主婦と生活') != -1) {
    plus = '主婦と生活杜';
  } else if (pub.indexOf('世界文化') != -1) {
    plus = '世界文化杜';
  } else if (pub.indexOf('スクウェア・エニックス') != -1) {
    plus = 'FF&DQ杜';
  } else if (pub.indexOf('ダイヤモンド') != -1) {
    plus = '永遠の輝き杜';
  }else if (pub.indexOf('宝島') != -1) {
    plus = 'トレジャー島社';
  } else if (pub.indexOf('徳間') != -1) {
    plus = '徳間deジブリ書店';
  } else if (pub.indexOf('日経') != -1) {
    plus = '上から日経杜';
  } else if (pub.indexOf('PHP') != -1) {
    plus = 'PHP研究所';
  } else if (pub.indexOf('扶桑') != -1) {
    plus = '扶桑杜';
  } else if (pub.indexOf('プレジデント') != -1) {
    plus = '社長杜';
  } else if (pub.indexOf('ベネッセ') != -1) {
    plus = '昔は福武書店';
  } else if (pub.indexOf('ポプラ') != -1) {
    plus = 'ポプラ杜';
  } else if (pub.indexOf('山と渓谷') != -1) {
    plus = '山と渓谷';
  } else {
    plus = '有象無象';
  }
  let charaName = nameParts + ' @' + plus;
  
  const jobs    = ['勇者','戦士','武闘家','魔法使い','僧侶','商人','遊び人','賢者','盗賊','踊り子','吟遊詩人','CSV'];
  let job_rand  = culc_rand_num(1, jobs.length-1);
  let jobName   = jobs[job_rand];

  player1 = document.getElementById('content1');
  player2 = document.getElementById('content2');
  player3 = document.getElementById('content3');
  player4 = document.getElementById('content4');
  player1.innerHTML = '名前：' + charaName;
  player2.innerHTML = '属性：' + attribute;
  player3.innerHTML = '職業：' + jobName;
  player4.innerHTML = 'CodeName：' + codeName;
})
.catch(function (error) {
  console.log(error);
});

</script>

</body>
</html>
