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

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://assets.what3words.com/sdk/v3/what3words.js?key=Z9Y6EOLM"></script>

<script>
let isbn_s         = '9784492532706'; //ここに楽天APIの「isbn」を入れる
let booksGenreId_s = '1006018002';    //ここに楽天APIの「booksGenreId」を入れる
let isbn           = Number(isbn_s);
let booksGenreId   = Number(booksGenreId_s);

let base_plus      = isbn + booksGenreId;
let base_minus     = isbn - booksGenreId;

let rand_lon1      = culc_rand_num(139, 139);
let rand_lon2      = culc_rand_num(base_minus, base_plus);
let rand_lat1      = culc_rand_num(35, 35);
let rand_lat2      = culc_rand_num(isbn, base_plus);

function culc_rand_num(min, max) {
  return Math.floor(Math.random() * (max - min + 1) + min);
}

let result1 = String(rand_lon2);
let result2 = String(rand_lat2);
let res1    = result1.slice(-3);
let res2    = result2.slice(-3);
console.log(res1);
console.log(res2);

const longitude = res1;
const latitude  = res2;
const baseURL   = 'https://api.what3words.com/v3/convert-to-3wa?key=Z9Y6EOLM'

let word = '';
axios.get(baseURL+'&coordinates=35.669' + latitude + ',139.703' + longitude + '&language=ja&format=json')
.then(function (response) {
  console.log(response);
  let words = response.data.words;
  word = words.split('・'); //指定した区切りで分割して配列に格納
  console.log(word);

  let what_num = culc_rand_num(0, 1);
  let name1 = word[what_num];
  let name2 = word[2];

  let plus_name = '';
  let name_s = culc_rand_num(1, 3);
  if(name_s==1){
    plus_name = 'de';
  }
  if(name_s==2){
    plus_name = '＆';
  }
  if(name_s==3){
    plus_name = '＠';
  }
  console.log(plus_name);

  const name = name1 + plus_name + name2;
  console.log(name);

  let pub = '角川'; //ここに楽天APIの「publisherName」を入れる
  let plus = '';
  if (pub.indexOf('角川') != -1) { //strに引数を含む場合の処理
    plus = '角かわん';
  }
  if (pub.indexOf('KADOKAWA') != -1) {
    plus = '角かわん';
  }
  if (pub.indexOf('学研') != -1) {
    plus = '振り返れば学研';
  }
  if (pub.indexOf('幻冬舎') != -1) {
    plus = '幻の冬';
  }
  if (pub.indexOf('光文社') != -1) {
    plus = '光は文';
  }
  if (pub.indexOf('講談') != -1) {
    plus = '講じ談じ';
  }
  if (pub.indexOf('集英') != -1) {
    plus = '集まったー英';
  }
  if (pub.indexOf('新潮') != -1) {
    plus = 'ニュー潮';
  }
  if (pub.indexOf('小学館') != -1) {
    plus = 'スモール学館';
  }
  if (pub.indexOf('主婦と生活') != -1) {
    plus = '主婦と生活';
  }
  if (pub.indexOf('世界文化') != -1) {
    plus = '世界な文化';
  }
  if (pub.indexOf('スクウェア・エニックス') != -1) {
    plus = 'FFとDQ';
  }
  if (pub.indexOf('ダイヤモンド') != -1) {
    plus = '永遠の輝き';
  }
  if (pub.indexOf('宝島') != -1) {
    plus = 'トレジャーな島';
  }
  if (pub.indexOf('徳間') != -1) {
    plus = '徳間deジブリ';
  }
  if (pub.indexOf('日経') != -1) {
    plus = '上から日経';
  }
  if (pub.indexOf('PHP研究所') != -1) {
    plus = 'PHPを研究なう';
  }
  if (pub.indexOf('扶桑社') != -1) {
    plus = '扶と桑';
  }
  if (pub.indexOf('プレジデント') != -1) {
    plus = '社長と大統領';
  }
  if (pub.indexOf('ベネッセ') != -1) {
    plus = 'べねっせでっせ';
  }
  if (pub.indexOf('ポプラ') != -1) {
    plus = 'ポップラ';
  }
  if (pub.indexOf('山と渓谷社') != -1) {
    plus = 'そこに山と渓谷';
  }

  const jobs = ['勇者','戦士','武闘家','魔法使い','僧侶','商人','遊び人','賢者','盗賊','踊り子','吟遊詩人','CSV',];
  let job_rand = culc_rand_num(1, jobs.length-1);
  console.log(job_rand);
  console.log(jobs[job_rand]);
  console.log(plus);

  player1 = document.getElementById('content1');
  player2 = document.getElementById('content2');
  player3 = document.getElementById('content3');
  player1.innerHTML = plus+' 族';
  player2.innerHTML = name;
  player3.innerHTML = '職業 '+jobs[job_rand];

})
.catch(function (error) {
  console.log(error);
});

</script>

</body>
</html>
