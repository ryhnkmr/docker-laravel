function calc_param(data){
    //変数用意
    let r_BookTitle = data.Items[0].Item.title;
    let r_isbn13 = data.Items[0].Item.isbn;
    let r_BookAuthor = data.Items[0].Item.author;
    let r_PublishedDate = data.Items[0].Item.salesDate;
    let r_BookDescription = data.Items[0].Item.itemCaption;
    let r_reviewCount = data.Items[0].Item.reviewCount;
    let r_reviewAverage = data.Items[0].Item.reviewAverage;
    let r_BookThumbnail = '<img src=\"' + data.Items[0].Item.largeImageUrl + '\" />';
    let r_price = data.Items[0].Item.itemPrice;
    let r_size = data.Items[0].Item.size;
    let r_page = data.Items[0].Item.reviewAverage;
    let r_genre = data.Items[0].Item.booksGenreId;

    //パラメータの前準備
    let date = r_PublishedDate.replace(/年/g,'').replace(/月/g,'').slice(0, 6); //出版日の整形
    if(r_reviewAverage<2){r_reviewAverage=2};//レビュー評価の調整
    //概要の文字数取り、ボーナスポイント（倍数）決定
    let length = r_BookDescription.length;
    let bonus = 1;
    if(length<50){
        bonus = 1.2
    }else if(50<=length && length<300){
        bonus = 1.5
    }else{
        bonus = 2
    }

    hp = Math.round(1500 * date/100000);
    dp = 100 * r_reviewAverage;
    ap = Math.round(180 * date/100000 + r_price/10);

    //ボーナスポイント積算
    let month = date.slice(-2);//出版月取得
    if(month == "01" || month == "04"){dp = Math.round(dp * bonus)}; //防御力アップ
    if(month == "07" || month == "11"){ap = Math.round(ap * bonus)}; //攻撃力アップ
}
