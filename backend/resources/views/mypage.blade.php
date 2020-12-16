<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>mypage</title>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</nav>
</head>

<style>
    body{
        color:#73879c; background:#f7f7f7;
    }
</style>
<body>
    <div class="container-fluid">
        
            <!-- top -->
            <div class="">
                <nav class="navbar navbar-light bg-light" >
                    <p class="navbar-brand">TITLE</p>
                </nav>
            </div>

        <div class="row"> 
            <!-- left -->
            <div class="col-sm-3 col-lg-2 sidebar bg-info text-white"> 
                <div></div>
                <div class="divider"></div>
            </div>
            <!-- right -->
            <div class="col-md-8 ">
            メイン表示
            </div>
        </div>
    </div>
</body>
</html>
