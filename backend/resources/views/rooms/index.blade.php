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
      <button type="button" class="btn btn-primary"><a href="{{route('rooms.create')}}">ルームを作成して待機</a></button>
      <div class="room-list mt-3">
        <div class="d-flex flex-row bd-highlight mb-3 flex-wrap">
          {{-- <div class="p-5 bd-highlight">Flex item 1</div>
          <div class="p-5 bd-highlight">Flex item 2</div>
          <div class="p-5 bd-highlight">Flex item 3</div> --}}
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">ホゲホゲ</h5>
              <h6 class="card-subtitle m-2 text-muted">ホスト：ホゲ</h6>
              <h6 class="card-subtitle m-2 text-muted">レート：2000</h6>
              <h6 class="card-subtitle m-2 text-muted">戦績：1win 0lose</h6>
              <a href="#" class="card-link">参加する</a>
            </div>
          </div>
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">参加する</a>
            </div>
          </div>
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">参加する</a>
            </div>
          </div>
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">参加する</a>
            </div>
          </div>
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">参加する</a>
            </div>
          </div>
          <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="card-link">Card link</a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>
          {{-- @forelse($rooms as $room)
          
          @empty
            <p>現在参加できるルームはありません。</p>
          @endforelse  --}}
        </div>
        
        
      </div>
    </div>

  </body>
</html>
