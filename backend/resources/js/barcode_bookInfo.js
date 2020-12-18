//バーコードリーダー機能
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
    alert(code);
    if(code.slice(0,3)==978){ //isbnコード上3桁チェック
        rakuten_info(code);
        Quagga.stop();
        turn_off_video();
    }
})

//楽天のAPI叩いて情報とってくる
//変数用意
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

//ビデオ表示オフ
function turn_off_video(){
    // 「id="jQueryBox"」を非表示
    $("#interactive").css("display", "none");
}

//パラメータ計算
function calc_param(){
    //パラメータ計算の前準備
    let date = r_PublishedDate.replace(/年/g,'').replace(/月/g,'').slice(0, 6); //出版日の整形
    if(r_reviewAverage<2){r_reviewAverage=2};//レビュー評価の調整
    let genre = r_genre.slice(3,6); //ジャンル取得 (3桁取得 上3桁除く)

    //概要の文字数取得、ボーナスポイント（倍数）決定
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

    //ボーナスポイント積算
    let month = date.slice(-2);//出版月取得
    if(month == "07" || month == "11"){ap = Math.round(ap * bonus)}; //攻撃力アップ
    if(month == "01" || month == "04"){dp = Math.round(dp * bonus)}; //防御力アップ

    //キャラパラメーター表示
    show_char_data(hp, ap, dp, r_BookThumbnail);
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

//char-tableのcolumn
//id,uid,name(name合成API),hp,ap,dp,exp(初期値0),lv(初期値1),thumnailURL,pictoURL(合成),size

//apiデータなかった場合、ビデオ再表示・Guagga再起動
