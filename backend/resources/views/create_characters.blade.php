<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Create My Character with a Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    .agba_box{
        background-color: rgba(255,255,255,0.8);
    }
</style>

</head>

<body>

<body>
    <div class="container-fluid" style="background-image: url({{ asset('img/265990_m.jpg') }});">
        <div class="row" style="height:1000px;">
            <div class="left_column  col-md-3 pt-4">
                <div class="agba_box p-4" style="height:150px;">
                <h2>SCORE</h2>
                <div id="" style="font-size:40px; font-weight: bold;">00000</div>
                </div>
                    <div style="height:680px;"></div>
                    <div class="agba_box p-2" style="height:80px;">
                <div id=""  style="font-size:40px; font-weight: bold;">user_name</div>
                </div>
            </div>

            <div class="main_column  col-md-6 pt-4 ">
                <div class="bg-white col text-center" style="height:380px;">
                        <!-- キャンバス（画像合成部） -->
                    <div class="can3 pt-4">
                        <canvas id="canvas3" width=200 height=200></canvas>
                    </div>
                    <!-- <img src="{{asset('img/picto_img/20201221-144546-1.png')}}" class="pt-4" style="width:35%;"> -->
                </div>
                <div class="bg-white col text-center" style="height:60px;">
                <div id="name" style="font-size:40px; font-weight: bold;">キャラクター名</div> 
                </div>
                <div class="bg-white" style="height:500px;">
                    <!-- camera ウインドウ -->
                    <div id="interactive" class="viewport col text-center"></div>
                    <button id="test">テスト用</button>
                    <div class="auth">{{Auth::user()->id}}
                    </div>
                </div>
                
            </div>

            <div class="right_column col-md-2 pt-4">
                <div class="agba_box mb-4 p-3" style="height:120px;">
                <h2>HP</h2>
                <div id="hp" style="font-size:40px; font-weight: bold;">000000</div>
                </div>
                
                <div class="agba_box mt-4 p-3" style="height:120px;">
                <h2>AP</h2>
                <div id="ap" style="font-size:40px; font-weight: bold;">000000</div>
                </div>
                <div class="agba_box mt-4 p-3" style="height:120px;">
                <h2>DP</h2>
                <div id="dp" style="font-size:40px; font-weight: bold;">000000</div>
                </div>
                <div                  style="height:420px;"></div>
                <div class="agba_box p-2" style="height:80px;">
                <div id="" style="font-size:40px; font-weight: bold;">DATE</div> 
                
                </div>
            </div>
        </div>
    </div>
</body>






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
    

    

    <!-- guaggaとjquery、JSの読み込み -->
    <script type="text/javascript">
        let user_id= <?php echo(Auth::user()->id) ?>;
    </script>
    <script src="https://serratus.github.io/quaggaJS/examples/js/quagga.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://assets.what3words.com/sdk/v3/what3words.js?key=Z9Y6EOLM"></script>
    <script src="/js/app.js"></script>

</body>

</html>
