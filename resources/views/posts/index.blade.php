<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href="{{ asset('/css/app.css') }}">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">


</head>


<body>

  <header>

    <h1>POST</h1>

  </header>


  <div class='container'>
    <p class="pull-right">
      <a class="btn btn-success" href="/create-form">投稿する</a>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-success add">ログアウト</a>
    <form id='logout-form' action="{{ route('logout') }}" method="POST">
      @csrf
    </form>
    </p>

    <div class="sub-heading">
      <div id="search">
        <h2 class='page-header'>投稿一覧</h2>


        <form id="search-form" action="{{ route('search') }}" method="GET">
          @csrf
          <input type="text" id="search-input" name="keyword" placeholder="投稿内容で検索">
          <button type="submit" class="search-button list-btn">検索</button>
        </form>
      </div>

      <!-- <div id="search">
        <form id="search-form">
          <input type="text" id="search-input" placeholder="投稿内容で検索">
          <button type="submit" class="search-button list-btn">検索</button>
        </form>
      </div>
    </div> -->

      <!-- <script>
      // 検索処理を関数化
      function performSearch(event) {
        event.preventDefault(); // デフォルトのイベントをキャンセル

        var keyword = document.getElementById("search-input").value.trim().toLowerCase(); // 検索キーワードを取得

        // テーブルの行を正しく選択
        var rows = document.querySelectorAll(".contents table tr");

        // キーワードに一致する行が存在するかどうか
        var hasMatch = false;

        rows.forEach(function(row) {
          var contentCell = row.querySelector("td:nth-child(3)"); // 投稿内容のセル
          var text = contentCell.textContent.toLowerCase();
          // 行全体のテキストを小文字に変換
          if (text.includes(keyword)) {
            row.style.display = "";
            // キーワードが含まれる場合は表示
            hasMatch = true;
            // 一致が見つかったらフラグをtrueに設定
          } else {
            row.style.display = "none";
            // キーワードが含まれない場合は非表示
          }
        });

        // エラーメッセージを表示または非表示にする
        var errorMessage = document.getElementById("error-message");
        if (!hasMatch && keyword) {
          errorMessage.textContent = "検索結果は0件です。";
        } else {
          errorMessage.textContent = "";
        }
      }

      // 検索ボタンのクリックイベントを追加
      document.getElementById("search-form").addEventListener("submit", function(event) {
        event.preventDefault();
        performSearch(event);
      });
    </script> -->

      <div class="contents">


        <table class='table table-hover'>

          <tr class="item">

            <th>投稿No</th>

            <th>投稿者名</th>

            <th>投稿内容</th>

            <th>投稿時間</th>

            <th>編集時間</th>

            <th></th>

            <th></th>

          </tr>


          @foreach ($lists as $list)

          <tr>

            <td>{{ $list->id }}</td>

            <td>{{ $list->user_name }}</td>

            <td>{{ $list->contents }}</td>

            <td>{{ $list->created_at }}</td>

            <td>{{ $list->updated_at }}</td>

            <!-- ログインユーザーと投稿者の名前が一致する場合にのみ削除ボタンを表示 -->
            @if(Auth::check() && Auth::user()->name === $list->user_name)
            <td><a class="btn btn-primary" href="/post/{{ $list->id }}/update-form">更新</a></td>

            <td><a class="btn btn-danger" href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
            @else
            <td></td>
            <td></td>
            <!-- ログインユーザーと投稿者が一致しない場合は空のセルを表示 -->
            @endif


          </tr>

          @endforeach

        </table>

      </div>


      <div id="error-message" style=" margin-top: 10px;"></div>
    </div>

    <footer>

      <small>Laravel@crud.curriculum</small>

    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>


</html>
