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
    // alert("started");
}
})

//ISBN13桁コードのチェックデジット
const calc = isbn => {
    const arrIsbn = isbn
    .toString()
    .split("")
    .map(num => parseInt(num));
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
if(calc(code)) rakuten_info(code),turn_off_video();
})

//楽天のAPI叩いて情報とってくる
function rakuten_info(isbn){
    const r_url = "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&applicationId=1080706320822310184&isbn=" + isbn;
    console.log(r_url);
    $.getJSON(r_url, function(data) {
    if(!data.Items) {
        $("#isbn13").val("");
        $("#BookTitle").text("");
        $("#BookAuthor").text("");
        $("#isbn13").text("");
        $("#PublishedDate").text("");
        $("#BookThumbnail").text("");
        $("#BookDescription").text("");
        $("#message").html('<p class="bg-warning" id="warning">該当する書籍がありません。</p>');
        $('#message > p').fadeOut(3000);
    } else {
    // 該当書籍が存在した場合、JSONから値を取得して入力項目のデータを取得し入力
        $("#r_BookTitle").text(data.Items[0].Item.title);
        $("#r_isbn13").text(data.Items[0].Item.isbn);
        $("#r_BookAuthor").text(data.Items[0].Item.author);
        $("#r_PublishedDate").text(data.Items[0].Item.salesDate);
        $("#r_BookDescription").text(data.Items[0].Item.itemCaption);
        $("#r_reviewCount").text(data.Items[0].Item.reviewCount);
        $("#r_reviewAverage").text(data.Items[0].Item.reviewAverage);
        $("#r_BookThumbnail").html('<img src=\"' + data.Items[0].Item.largeImageUrl + '\" />');
        $("#r_price").text(data.Items[0].Item.itemPrice);
        $("#r_size").text(data.Items[0].Item.size);
        $("#r_page").text(data.Items[0].Item.reviewAverage);
        $("#r_genre").text(data.Items[0].Item.booksGenreId);
    }
    });
}

//ビデオ表示オフ
function turn_off_video(){
    // 「id="jQueryBox"」を非表示
    $("#interactive").css("display", "none");
}
