<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create My Character with a Book</title>
</head>

<body>
    <!-- camera ウインドウ -->
    <div id="interactive" class="viewport"></div>
    <button id="test">テスト用</button>
    <div class="auth">{{Auth::user()->id}}
    </div>

    <!-- 結果表示 -->
    <div class="R_book_info">
        <h1>Rakuten Books</h1>
        <div id="message"></div>
        <h2 id="r_BookTitle"></h2>
        <div>isbn13: <span id="r_isbn13"></span></div>
        <div>著者: <span id="r_BookAuthor"></span></div>
        <div>初版: <span id="r_PublishedDate"></span></div>
        <div>概要: <span id="r_BookDescription"></span></div>
        <div>価格: <span id="r_price"></span></div>
        <div>サイズ: <span id="r_size"></span></div>
        <div>レビュー数: <span id="r_reviewCount"></span></div>
        <div>レビュー平均: <span id="r_reviewAverage"></span></div>
        <div>ジャンルID: <span id="r_genre"></span></div>
        <div id="r_BookThumbnail"></div>
    </div>

    <div class="chara-info">
        <h1>キャラクター</h1>
        <h2>名前：<span id="name"></span></h2>
        <div>HP: <span id="hp"></span></div>
        <div>攻撃力: <span id="ap"></span></div>
        <div>防御力: <span id="dp"></span></div>
        <div>レベル: <span id="lv"></span></div>
        <div id="r_BookThumbnail"></div>
    </div>
    
    <!-- キャンバス（画像合成部） -->
    <div class="can3">
        <canvas id="canvas3" width=200 height=200></canvas>
    </div>


    <!-- guaggaとjquery、JSの読み込み -->
    <script type="text/javascript">
        let user_id= <?php echo(Auth::user()->id) ?>;
    </script>
    <script src="https://serratus.github.io/quaggaJS/examples/js/quagga.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
    <script src="/js/app.js"></script>

</body>

</html>
