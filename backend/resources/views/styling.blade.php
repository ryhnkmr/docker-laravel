<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    .agba_box{
        background-color: rgba(255,255,255,0.8);
    }

    </style>

</head>
<body>
    <div class="container" style="background-image: url({{ asset('img/265990_m.jpg') }});">
        <div class="row" style="height:900px;">
            <div class="left_column  col-md-3 pt-4">
                <div class="agba_box p-4" style="height:150px;">score</div>
                <div style="height:650px;"></div>
                <div class="agba_box p-1" style="height:50px;">user_name</div>
            </div>

            <div class="main_column  col-md-6 pt-4 ">
                <div class="bg-white col text-center" style="height:500px;">
                    <img src="{{asset('img/picto_img/20201221-144546-1.png')}}" class="pt-5" style="width:70%;">
                </div>
                <div class="bg-white" style="height:300px;">カメラ</div>
                <div class="bg-white col text-center" style="height:50px;">キャラクター名</div>
            </div>

            <div class="right_column col-md-3 pt-4">
                <div class="agba_box mb-4 p-4" style="height:80px;">HP</div>
                <div class="agba_box mt-4 p-4" style="height:80px;">AP</div>
                <div class="agba_box mt-4 p-4" style="height:80px;">DP</div>
                <div                  style="height:510px;"></div>
                <div class="agba_box p-1" style="height:50px;">date</div>
            </div>
        </div>
    </div>
</body>
</html>
