<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🐤ブックdeバーコードバトラー📚</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('/img/favicon.ico') }}">
    <style>
    /* ボタンCSS */
        .join-button{
            display: inline-block;
            padding: .2em 2.5em;
            border: 5px solid black;
            border-radius: .4em 2em .5em 3em/3em .5em 2em .5em;
            color: #708090;
            background-color: ivory;
            font-family: 'Covered By Your Grace', cursive;
            font-weight: 400;
            text-decoration: none;
            text-align: center;
        }
        .wf-nicomoji
         { font-family: "Nico Moji"; }
         .wf-roundedmplus1c
         { font-family: "M PLUS Rounded 1c"; }


    </style>

</head>
<body style="background-color: #FFEFDA;">
    <div class="container">

        <!-- <div class="row" style="margin-top:50px;">
            <div class="col-md-12 text-center">
                <p class="wf-nicomoji" style="color:orange; font-size:50px;">ブックdeバーコードバトラー</p>
            </div>
        </div>
        <div class="row" style="margin-top:30px;">
            <div class="col-md-12 text-center">
                <h4 class="wf-roundedmplus1c" style="color:gray;">
                    ようこそ本のせかいへ<br>
                    ぶらぶらぶらぶら～あぶらかたぶら～     
                </h4>
            </div>
        </div> -->

        <div class="container" style="width: 68%;">
            <div class="row" style="margin-top:40px;">
                <div class="col-md-12 text-center">
                    <img src="{{asset('img/top_h.png')}}" class="" style='width: 100%;'>
                </div>
            </div>
        </div>

        <div class="row">
            @if (Route::has('login'))
                <div class="row col text-center">
                    <div class="col-md-12" style="margin-top:30px;">
                        @auth
                            <a href="{{ url('/home') }}"><input type="button" class="join-button" value="ホーム"></a>
                            @else
                            <a href="{{ route('login') }}"><input type="button" class="join-button wf-roundedmplus1c" value="ログイン"></a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"><input type="button" class="join-button wf-roundedmplus1c" value="新規登録" style='margin-left: 18px;'></a>
                            @endif
                        @endauth
                    </div>
                </div>
            @endif
        </div>

        <div class="container">
            <div class="row" style="margin-top:40px;">
                <div class="col-md-12 text-center">
                    <img src="{{asset('img/top_b.png')}}" class="" style='width: 100%;'>
                </div>
            </div>
        </div>

    
</div>









</html>
