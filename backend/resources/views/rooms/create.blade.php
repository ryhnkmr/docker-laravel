<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body>
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
    <div class="container">
      {{-- <form> --}}
        <div class="form-group">
          <label for="exampleInputEmail1">ルーム名</label>
          <input type="text" class="form-control" id="room_name" placeholder="ルーム名を入力" name="name">
        </div>
        {{-- ToDo: 時間余裕があればやる --}}
        {{-- <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">roomをシークレットにする<div class=""></div></label>
        </div> --}}
        <button id='submit-btn' type="submit" class="btn btn-primary">作成</button>
      {{-- </form> --}}
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script>
      console.log('test')
      btn = document.getElementById('submit-btn');
      btn.onclick = function() {
        axios.post('/api/rooms', {
          name: document.getElementById('room_name').value,
          user_id: <?php echo(Auth::user()->id)?>
        }).then(function (response) {
          window.location = response.data.id;
          console.log(response);
        })
        .catch(function (error) {
          console.log(error);
        });
      }


    </script>
  </body>
</html>
