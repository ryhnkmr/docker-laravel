<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>MyPage</title>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</nav>
</head>

<style>
    body{
        color:#6c757d; background:#f7f7f7;
    }
</style>
<body>
    <div class="container">
        
<!-- top -->
            <div class="">
                <nav class="navbar navbar-light bg-light" >
                    <h1 class="navbar-brand">TITLE</h1>
                </nav>
            </div>

        <div class="row"> 
<!-- left -->
                <div class="col-xl-3 col-sm-4 sidebar bg-warning "> 

                        <!--ユーザーアイコンとユーザーネーム-->
                    <div class="usericonname d-flex justify-content-center ">
                            <div class="profile-usertitle-name">
                                <img src="https://placehold.jp/100x100.png" alt="" class="m-3">
                                <h3 class="font-weight-bold">Username</h3>
                            </div>
                    </div>

                    <!--戦績-->
                    <div class="profile-user-pointrrecord font-weight-bold">
                        <div class="profile-user-pointtitle ">POINTS</div>
                        <div class="profile-user-point col-8 border border-dark bg-white mx-auto m-2">
                            <p class="d-flex align-items-center justify-content-center">echo 1800.'Pt';</p>  
                        </div>
                        <div class="profile-user-recordtitle">Battle Record</div>
                        <div class="profile-user-record col-8 border border-dark bg-white mx-auto m-2">
                            <p class="text-center">5win 3lose</p>
                        </div>
                    </div>
                </div>

<!-- right -->
            <div class="col-xl-9 col-sm-8 main">
                    <!--ゲームのメニュー-->
                    <div class="main-operation ">
                        <!--準備-->
                        <div class="row my-4"> 
                           
                                <div class="RoomSet mx-auto">
                                    <button type="button" class="btn btn-primary btn-md ">CharacterSet</button>    
                                </div>

                                <div class="RoomSet mx-auto">
                                    <button type="button" class="btn btn-primary btn-md">BattleRoom</button>    
                                </div>

                                <div class="RoomSet mx-auto">
                                    <button type="button" class="btn btn-primary btn-md">BetRoom</button>
                                </div>
                            
                        </div>

                        <div class="main-todaysNews bg-white text-dark">
                            <!--ニュース-->
                            <div class="m-2">
                                <ul>
                                    <p>Today's News</p>
                                    <li>テストテスト</li>
                                    <li>テストテスト</li>
                                    <li>テストテスト</li>
                                </ul>
                             </div>
                        </div>
                    </div>
                    <div class="main-team bg-info">
                        <!--スターティングメンバ―-->
                        <div class="main-team-starting my-2"> 
                            <div class="main-team-yourteam ">
                                <h3 class="p-4 font-weight-bold">YOUR TEAM</h3>
                                    <div class="row col-8 mx-auto">
                                        <div class="m-3">
                                            <img src="https://placehold.jp/140x200.png" alt="">
                                        </div>
                                        <div class="m-3">
                                            <img src="https://placehold.jp/140x200.png" alt="">
                                        </div>
                                        <div class="m-3">
                                            <img src="https://placehold.jp/140x200.png" alt="">
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="main-team-stock"> <!--ストック-->
                            <div class="main-team-stock-name sm-5">
                                <h3 class="p-4 font-weight-bold">Stock CharactorsStock</h3>
                                    <tr>
                                        <div class="row col-8 mx-auto">
                                            <div class="m-3">
                                                <img src="https://placehold.jp/70x70.png" alt="">
                                            </div>
                                            <div class="m-3">
                                                <img src="https://placehold.jp/70x70.png" alt="">
                                            </div>
                                            <div class="m-3">
                                                <img src="https://placehold.jp/70x70.png" alt="">
                                            </div>
                                            <div class="m-3">
                                                <img src="https://placehold.jp/70x70.png" alt="">
                                            </div>
                                            <div class="m-3">
                                                <img src="https://placehold.jp/70x70.png" alt="">
                                            </div>
                                        </div>
                                    </tr>   
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <script src="/js/app.js"></script>
</body>
</html>
