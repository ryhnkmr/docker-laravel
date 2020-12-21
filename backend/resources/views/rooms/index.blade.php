<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      @csrf
      <div class="">
        <nav class="navbar navbar-light bg-light" >
            <h1 class="navbar-brand">TITLE</h1>

            <a class="text-right" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
            </a>
        </nav>
      </div>
      <h1>現在参加できるルーム一覧</h1>
      <a href="{{route('rooms.create')}}"><button type="button" class="btn btn-success">ルームを作成して待機</button></a>
      <div class="room-list mt-3">
        <div class="d-flex flex-row bd-highlight mb-3 flex-wrap">
          @forelse($rooms as $room)
            @foreach($room->users as $user)
              <div class="card m-3" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">{{$room->name}}</h5>
                  <h6 class="card-subtitle m-2 text-muted">ホスト：{{$user->name}}</h6>
                  <h6 class="card-subtitle m-2 text-muted">レート：{{$user->rate}}</h6>
                  <h6 class="card-subtitle m-2 text-muted">戦績：{{$user->wincount}}win{{$user->losecount}}lose</h6>
                  <button id="join-btn" type="button" class="btn btn-primary" value={{(int) $room->id}}>参加する</button>                </div>
              </div>
            @endforeach
          @empty
            <p>現在参加できるルームはありません。</p>
          @endforelse 
        </div>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script>
          join_btn = document.getElementById('join-btn');
          join_btn.onclick = function() {
            axios.post('/api/rooms/join', {
              user_id: <?php echo(Auth::user()->id )?>,
              room_id: join_btn.value,
            }).then(function (response) {
              window.location =  'rooms/' + response.data.id;
            }).catch(function (error) {
              console.log(error);
            });
          }
        </script>
      </div>
    </div>

  </body>
</html>
