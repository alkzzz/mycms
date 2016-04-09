<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Internal Server Error</title>
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

  </head>
  <body class="error">
    <div class="container jumbotron">
      <div class="col-lg-8 col-lg-offset-2 text-center">
        <div class="logo">
          <h1>500 Internal Server Error</h1>
        </div>
        <p class="lead">Maaf, Server website sedang mengalami error</p>
        <div class="clearfix"></div>
        <div class="col-lg-6 col-lg-offset-3">
          <form role="search" action="{{ url(Localization::getCurrentLocale().'/search') }}">
            <div class="input-group">
              <input type="text" name="q" placeholder="Search ..." class="form-control">
              <span class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
            </span>
            </div>
          </form>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="col-lg-6 col-lg-offset-3">
          <div class="btn-group btn-group-justified">
            <a href="{{ route('homepage') }}" class="btn btn-success">Back to Homepage</a>
          </div>
        </div>
      </div><!-- /.col-lg-8 col-offset-2 -->
    </div>
  </body>
</html>
