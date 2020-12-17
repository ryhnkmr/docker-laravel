<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>mypage</title>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/mypage.css')}}" rel="stylesheet">
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
                <div class="col-sm-3 col-lg-2 sidebar bg-warning"> 
                    <!--ユーザーアイコン-->
                    <div class="profile-sidebar"> 
                        <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive">
                    </div>

                    <!--ユーザーネーム-->
                    <div class="profile-user-title"> 
                        <div class="profile-usertitle-name">Username</div>
                    </div>

                    <!--戦績-->
                    <div class="profile-user-pointrrecord">
                        <div class="profile-user-pointtitle">POINTS</div>
                        <div class="profile-user-point">1800pt</div>
                        <div class="profile-user-recordtitle">Battle Record</div>
                        <div class="profile-user-record">5win 3lose</div>
                    </div>
                </div>

            <!-- right -->
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-log-offset-2 main">
                
                    <div class="main-operation bg-danger"><!--ゲームのメニュー-->
                        <div class="row"> <!--準備-->
                            <div class="">CharacterSet</div>
                            <div class="">BattleRoom</div>
                            <div class="">BetRoom</div>
                        </div>
                        <div class="main-todaysNews">
                        Today's News
                        </div>
                    </div>
                    <div class="main-team bg-info">
                        <div class="main-team-starting"> <!--スターティングメンバ―-->
                            <div class="main-team-yourteam">Your Team</div>
                            <div class="row">
                                <div class="">1st</div>
                                <div class="">2nd</div>
                                <div class="">3rd</div>
                            </div>
                        </div>
                        <div class="main-team-stock"> <!--ストック-->
                            <div class="main-team-stock-name">Stock CharactorsStock</div>
                            <div class="row">
                                <div class=""></div>
                                <div class=""></div>
                                <div class=""></div>
                                <div class=""></div>
                                <div class=""></div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</body>
</html>
