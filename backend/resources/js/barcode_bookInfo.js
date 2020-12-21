// ************************
//   バーコードリーダーQuagga
// ************************
Quagga.init({
inputStream: {
    name: 'Live',
    type: 'LiveStream',
    target: document.querySelector('#interactive'),//埋め込んだdivのID
    constraints: {
    facingMode: 'environment',
    },
    area: {//必要ならバーコードの読み取り範囲を調整
    top: "0%",
    right: "0%",
    left: "0%",
    bottom: "0%"
    },
},
locator: {
    patchSize: 'medium',
    halfSample: true,
},
numOfWorkers: 2,
decoder: {
    readers: ['ean_reader']//ISBNは基本的にこれ（他にも種類あり）
},
locate: true,
}, (err) => {
if(!err) {
    Quagga.start();
}
})

//ISBN13桁コードのチェックデジット
const calc = isbn => {
    const arrIsbn = isbn.toString().split("").map(num => parseInt(num));
    let remainder = 0;
    const checkDigit = arrIsbn.pop();
    
    arrIsbn.forEach((num, index) => {
        remainder += num * (index % 2 === 0 ? 1 : 3);
    });
    remainder %= 10;
    remainder = remainder === 0 ? 0 : 10 - remainder;
    
    return checkDigit === remainder;
}

// codeが13桁のISBNだったら書籍情報とってきてビデオ表示なしにする
Quagga.onDetected(success => {
const code = success.codeResult.code;
if(calc(code))
    // alert(code);
    if(code.slice(0,3)==978){ //isbnコード上3桁チェック
        Quagga.stop();//ビデオ停止
        rakuten_info(code);//楽天API
        turn_off_video();//ビデオ領域非表示
    }
})

// ************************
// ///楽天Book function
// ************************
//楽天API用の変数用意
let r_BookTitle;
let r_isbn13;
let r_BookAuthor;
let r_PublishedDate;
let r_BookDescription;
let r_reviewCount;
let r_reviewAverage;
let r_BookThumbnail;
let thumbnail_origin;
let r_price;
let r_size;
let r_page;
let r_genre;

//Char-paramのグローバル変数用意
let hp, ap, dp;

//楽天のAPI叩いて情報取得
function rakuten_info(isbn){
    const r_url = "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&applicationId=1080706320822310184&isbn=" + isbn;
    $.getJSON(r_url, function(data) {
        //変数用意
        r_BookTitle = data.Items[0].Item.title;
        r_isbn13 = data.Items[0].Item.isbn;
        r_BookAuthor = data.Items[0].Item.author;
        r_PublishedDate = data.Items[0].Item.salesDate;
        r_BookDescription = data.Items[0].Item.itemCaption;
        r_reviewCount = data.Items[0].Item.reviewCount;
        r_reviewAverage = data.Items[0].Item.reviewAverage;
        r_BookThumbnail = '<img src=\"' + data.Items[0].Item.largeImageUrl + '\" />';
        thumbnail_origin = data.Items[0].Item.largeImageUrl;
        r_price = data.Items[0].Item.itemPrice;
        r_size = data.Items[0].Item.size;
        r_page = data.Items[0].Item.reviewAverage;
        r_genre = data.Items[0].Item.booksGenreId.slice(3,6);
        //データあるか確認
        if(!data.Items) {
            $("#r_isbn13").val("");
            $("#r_BookTitle").text("");
            $("#r_BookAuthor").text("");
            $("#r_PublishedDate").text("");
            $("#r_BookThumbnail").text("");
            $("#r_BookDescription").text("");
            $("#message").html('<p class="bg-warning" id="warning">該当する書籍がありません。</p>');
            $('#message > p').fadeOut(3000);
        } else {
        // 該当書籍が存在した場合、JSONから値を取得して入力項目のデータを取得し入力
            $("#r_BookTitle").text(r_BookTitle);
            $("#r_isbn13").text(r_isbn13);
            $("#r_BookAuthor").text(r_BookAuthor);
            $("#r_PublishedDate").text(r_PublishedDate);
            $("#r_BookDescription").text(r_BookDescription);
            $("#r_reviewCount").text(r_reviewCount);
            $("#r_reviewAverage").text(r_reviewAverage);
            $("#r_BookThumbnail").html(r_BookThumbnail);
            $("#r_price").text(r_price);
            $("#r_size").text(r_size);
            $("#r_page").text(r_page);
            $("#r_genre").text(r_genre);
        }
        // create_name(); //名前生成
        console.log(charaName);
        calc_param();  //パラメータ計算
        select_eyes(); //合成用の目
        get_thumbnail(thumbnail_origin); // クロスサイト回避→キャンバス合成
        console.log(pictoURL);

    });
}

//ビデオ表示オフ (ISBN読み取りと同時に起動)
function turn_off_video(){
    // 「id="jQueryBox"」を非表示
    $("#interactive").css("display", "none");
}

//**************************
///////名前の生成ロジック
//**************************

let charaName;
function create_name(){
    function culc_rand_num(min, max) { //ランダム生成の関数
        return Math.floor(Math.random() * (max - min + 1) + min);
    }
    const hiraToKana = text =>{ //かな→カナ変換の関数
        return text.replace( /[\u3042-\u3093]/g, 
        m => String.fromCharCode(m.charCodeAt(0) + 96)
        );
    };
    let isbn_s         = '9784492532706'; //★楽天APIの「isbn」
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
        charaName = codeName + ' @' + plus + "de" + jobName ;
        
        const jobs    = ['勇者','戦士','武闘家','魔法使い','僧侶','商人','遊び人','賢者','盗賊','踊り子','吟遊詩人','CSV'];
        let job_rand  = culc_rand_num(1, jobs.length-1);
        let jobName   = jobs[job_rand];

        // player1.innerHTML = '名前：' + charaName;
        // player2.innerHTML = '属性：' + attribute;
        // player3.innerHTML = '職業：' + jobName;
        // player4.innerHTML = 'CodeName：' + codeName;
    })
    .catch(function (error) {
        console.log(error);
    });
}

// ************************
// パラメータ計算（楽天BOOKfunctionで読み込み）
// ************************
function calc_param(){
    //パラメータ計算の前準備
    let date = r_PublishedDate.replace(/年/g,'').replace(/月/g,'').slice(0, 6); //出版日の整形
    if(r_reviewAverage<2){r_reviewAverage=2};//レビュー評価の調整
    let genre = r_genre.slice(3,6); //ジャンル取得 (3桁取得 上3桁除く)

    //概要の文字数取得、文字数でボーナス倍数を決定
    let length = r_BookDescription.length;
    let bonus = 1;
    if(length<50){
        bonus = 1.2
    }else if(50<=length && length<300){
        bonus = 1.5
    }else{
        bonus = 2
    }

    //パラメータ計算
    hp = Math.round(1500 * date/100000);
    ap = Math.round(180 * date/100000 + r_price/10);
    dp = 100 * r_reviewAverage;

    //ボーナス倍数を積算
    let month = date.slice(-2);//出版月取得
    if(month == "07" || month == "11"){ap = Math.round(ap * bonus)}; //攻撃力アップ
    if(month == "01" || month == "04"){dp = Math.round(dp * bonus)}; //防御力アップ

    //キャラパラメーター表示
    show_char_data(hp, ap, dp, r_BookThumbnail);
    post_param(hp,ap,dp);
}

//キャラパラメーター表示（更新予定）
function show_char_data(hp, ap, dp, r_BookThumbnail){
    $("#name").text("テスト");
    $("#hp").text(hp);
    $("#ap").text(ap);
    $("#dp").text(dp);
    $("#lv").text("01");
    $("#r_BookThumbnail").html(r_BookThumbnail);
}


// ************************
// // クロスサイト回避の機能 //楽天BOOKS_APIで読み込み
// ************************

let new_thumbnail_src = 0;
function get_thumbnail(thumbnail_origin){
    axios.post('api/picto', {
        url: thumbnail_origin
    }).then(function(data){//成功->表示処理を書く
        new_thumbnail_src = data.data;
        // console.log(new_thumbnail_src);
        create_canvas(new_thumbnail_src);
        },
        function(){ //失敗
            alert("呼び出し失敗");
        }
    );
};

// ************************
// ///合成の下準備
// ************************

//ランダム生成の関数
function culc_rand_num(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}
let rand_2 = culc_rand_num(1, 2);
let rand_3 = culc_rand_num(1, 3);
let rand_6 = culc_rand_num(1, 6);

//armパーツの選定
let arm_img = '';
arm_img     = "./img/char_img/arm_" + rand_6 + ".png";
//console.log(arm_img);

let eye_img = '';
function select_eyes(){
//eyeパーツの選定
    if(r_genre == "001" || r_genre == "021"){  //Group_a
        eye_img = "./img/char_img/eye_a_01.png";
    } else if(r_genre == "002" || r_genre == "008" || r_genre == "012" || r_genre == "016") {  //Group_b＋IMGファイルのストックは２
        eye_img = "./img/char_img/eye_b_0" + rand_2 + ".png";
    } else if(r_genre == "003" || r_genre == "004" || r_genre == "017" || r_genre == "019") {  //Group_c
        eye_img = "./img/char_img/eye_c_01.png";
    } else if(r_genre == "005" || r_genre == "006" || r_genre == "020") {  //Group_d＋IMGファイルのストックは２
        eye_img = "./img/char_img/eye_d_0" + rand_2 + ".png";
    } else if(r_genre == "007" || r_genre == "009" || r_genre == "010" || r_genre == "011" || r_genre == "028") {  //Group_e
        eye_img = "./img/char_img/eye_e_01.png";
    } else {  //Group_f
        eye_img = "./img/char_img/eye_f_01.png";
    }
}

// ************************
// /////画像合成function
// ************************

let pictoURL = 0;
//canvas3
let canvas=document.getElementById("canvas3");
let ctx=canvas.getContext("2d");

//イメージ作成
let thumbnail = new Image();
let arms = new Image();
let eyes = new Image();

function create_canvas(new_thumbnail_src){ //クロスサイト回避functionで読み込み
    //1.本の合成
    thumbnail.src = new_thumbnail_src;

    thumbnail.onload = function() {
        //本サムネイルのサイズを取得
        let margin_left = (200 - thumbnail.width)/2; //中央揃えのためのマージン取得
        ctx.drawImage(thumbnail, margin_left, 0, thumbnail.width, thumbnail.height);

        //2.腕の合成
        arms.src = arm_img; //腕のパス
        arms.onload = function() {
            ctx.drawImage(arms, 0, 0, 200, 200);
            
            //3.目の合成
            eyes.src = eye_img; //目のパス
            eyes.onload = function(){
                ctx.drawImage(eyes, 0, 0, 200, 200);
                //base64へ変換
                let picto_url  = canvas.toDataURL("image/png").replace(new RegExp("data:image/png;base64,"),"");
                // console.log(picto_url);
                axios.post('api/store_picto', {
                    picto_url: picto_url,
                    user_id: user_id
                }).then(function(data){//成功->表示処理を書く
                    pictoURL = data.data;
                    // console.log(pictoURL);
                    post_param();
                    },
                    function(){ //失敗
                        alert("呼び出し失敗");
                    }
                );
            }
        }
    };
}

// ************************
// テーブル挿入php用 axios通信
// ************************

function post_param(){
    //アニメーション挿入部

    //apiに送信
    axios.post('api/test', {
        user_id: user_id,
        name: 'ブックン',
        hp: hp,
        ap: ap,
        dp: dp,
        thumnailURL: thumbnail_origin,
        pictoURL: pictoURL
    }).then(function(data){//成功->表示処理を書く
                console.log(data);
            },
            function(){ //失敗
                alert("呼び出し失敗");
            }
        );
}

$('#test').on('click', function() {
    post_param(hp,ap,dp);
    // get_thumbnail(thumbnail_origin);
    create_name(); //名前生成
  });


//改良必要：
//apiデータなかった場合、ビデオ再表示・Guagga再起動
//読み込み部分のサイズ変更とマスキング

//メモ：
//-char-tableのcolumn
//id,uid,name(name合成API),hp,ap,dp,exp(初期値0),lv(初期値1),thumnailURL,pictoURL(合成),size
