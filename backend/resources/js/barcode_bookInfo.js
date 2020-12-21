// ************************
// //バーコードリーダー機能//
// ************************
// Quagga.init({
// inputStream: {
//     name: 'Live',
//     type: 'LiveStream',
//     target: document.querySelector('#interactive'),//埋め込んだdivのID
//     constraints: {
//     facingMode: 'environment',
//     },
//     area: {//必要ならバーコードの読み取り範囲を調整
//     top: "0%",
//     right: "0%",
//     left: "0%",
//     bottom: "0%"
//     },
// },
// locator: {
//     patchSize: 'medium',
//     halfSample: true,
// },
// numOfWorkers: 2,
// decoder: {
//     readers: ['ean_reader']//ISBNは基本的にこれ（他にも種類あり）
// },
// locate: true,
// }, (err) => {
// if(!err) {
//     Quagga.start();
// }
// })

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
        rakuten_info(code);//楽天API
        Quagga.stop();//ビデオ停止
        turn_off_video();//ビデオ領域非表示
    }
})


// ************************
// ////楽天ブックfunction
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
        //パラメータ計算
        calc_param();
    });
}


//ビデオ表示オフ (Quaggaで呼び出し)
function turn_off_video(){
    // 「id="jQueryBox"」を非表示
    $("#interactive").css("display", "none");
}

// ************************
// //パラメータ計算 (楽天Book apiで呼び出し)
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
// /////画像合成function
// ************************
const thumbnail_origin = 'https://thumbnail.image.rakuten.co.jp/@0_mall/book/cabinet/5705/9784774185705.jpg?_ex=200x200';
const arms_pass = "./img/char_img/arm_01_200_200.png";
const eyes_pass = './img/char_img/eye_salary_200_200.png';

//canvas3
let c=document.getElementById("canvas3");
let ctx=c.getContext("2d");

//イメージ作成
let thumbnail = new Image();
let arms = new Image();
let eyes = new Image();

let base_img;

//合成function(クロスサイト回避functionで読みこむ)
function create_canvas(new_thumbnail_src){
    //1.本の合成
    thumbnail.src = new_thumbnail_src;

    thumbnail.onload = function() {
        //本サムネイルのサイズを取得
        let img_width = thumbnail.width;  // 幅
        let img_height = thumbnail.height; // 高さ
        let margin_left = (200 - thumbnail.width)/2; //中央揃えのためのマージン取得
        ctx.drawImage(thumbnail, margin_left, 0, thumbnail.width, thumbnail.height);

        //2.腕の合成
        arms.src = "./img/char_img/arm_01_200_200.png";
        arms.onload = function() {
            ctx.drawImage(arms, 0, 0, 200, 200);
            
            //3.目の合成
            eyes.src = "./img/char_img/eye_salary_200_200.png";
            eyes.onload = function(){
                ctx.drawImage(eyes, 0, 0, 200, 200);
                //base64へ変換
                // let img = c.toDataURL("image/png"); //localhostではエラー
                // console.log(img);
                // document.write('<img src="' + img + '" width="200" height="200"/>');
            }
        }
    };
}

// ************************
// //クロスサイト回避function
// ************************
let new_thumbnail_src = 0;
function get_thumbnail(thumbnail_origin){
    axios.post('api/picto', {
        url: thumbnail_origin
    }).then(function(data){//成功->表示処理を書く
        new_thumbnail_src = data;
        // console.log(new_thumbnail_src);
        create_canvas(new_thumbnail_src);//キャンバス作成
        },
        function(){ //失敗
            alert("合成失敗");
        }
    );
};


// ************************
// テーブル挿入php用 axios通信
// ************************

function post_param(hp,ap,dp){
    //アニメーション挿入部

    //apiに送信
    axios.post('api/test', {
        user_id: user_id,
        name: 'ブックン',
        hp: 1,
        ap: 2,
        dp: 3,
        thumnailURL: 'https://',
        pictoURL: 'img/img.png'
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
    get_thumbnail(thumbnail_origin);
  });


//改良必要：
//apiデータなかった場合、ビデオ再表示・Guagga再起動
//読み込み部分のサイズ変更とマスキング

//メモ：
//-char-tableのcolumn
//id,uid,name(name合成API),hp,ap,dp,exp(初期値0),lv(初期値1),thumnailURL,pictoURL(合成),size
