<!DOCTYPE html>

<html>


<head>

  <meta charset='utf-8"'>

  <link rel='stylesheet' href='/css/app.css'>

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>


  <header>

    <h1 class='page-header'>POST</h1>

  </header>

  <div class='container'>

    <h2 class='page-header'>新しく投稿する</h2>

    {!! Form::open(['url' => '/create-form', 'method' => 'post']) !!}

    <div class="form-group">

      {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}

      <!--HTMLで書き換えると
       <input type="text" name="newPost" required class="form-control" placeholder="投稿内容">の意味 -->


    </div>

    <button type="submit" class="btn btn-success pull-right">追加</button>
    <!--
    <a href={{ route('logout') }} class="btn btn-success add">
      一覧に戻る
    </a> -->

    {!! Form::close() !!}

  </div>

  <footer>

    <small>Laravel@crud.curriculum</small>

  </footer>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>


</html>
