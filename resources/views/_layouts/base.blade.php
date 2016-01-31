<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CMS - @yield('title')</title>

    @section('css')
    <!-- Bootstrap -->
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show

  </head>
  <body>

  <div class="container">
  <div id="top-menu" class="hidden-xs">
  <ul class="list-inline navbar-left">
    @foreach($top_menu as $top_menu)
      <li><a href="{{ $top_menu->link_topmenu }}" target="_blank">{{ $top_menu->nama_topmenu }}</a></li>
    @endforeach
  </ul>
  <ul class="list-inline navbar-right">
    @section('lang')
    @if (Localization::getCurrentLocale() == 'id')
    <li><a href="{{Localization::getLocalizedURL('en') }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
    @else
    <li><a href="{{Localization::getLocalizedURL('id') }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
    @endif
    @show
  </ul>
  <form class="navbar-form navbar-right" role="search" action="{{ url(Localization::getCurrentLocale().'/search') }}">
  <div class="form-group">
      <input type="text" name="q" class="form-control" placeholder="Search">
  </div>
      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
  </form>
  </div>
  <img class="img-responsive" src="{{ asset('img/logo.jpg') }}">
  </div>

<div class="container">
      <!-- Main Menu -->
      <nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Fakultas Teknik</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="mobile-menu">
        <ul class="nav navbar-nav navbar-right">
            @section('lang-mobile')
            @if (Localization::getCurrentLocale() == 'id')
            <li class="visible-xs"><a href="{{Localization::getLocalizedURL('en') }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
            @else
            <li class="visible-xs"><a href="{{Localization::getLocalizedURL('id') }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
            @endif
            @show

            @include('_layouts.dropdown', ['items'=> $menu_mainmenu->roots()])
        </ul>
        <form class="navbar-form navbar-right visible-xs" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
        </form>
    </div><!-- /.navbar-collapse -->
</nav>

<div id="imageSlider" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @foreach($sliders as $key => $value)
    <li data-target="#imageSlider" data-slide-to="{{ $key }}" @if($key == 0) class="active"> @endif </li>
    @endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($sliders as $key => $feature)
    @if($key == 0)
    <div class="item active">
    @else
    <div class="item">
    @endif
    <img src="{{ $feature->slider->gambar }}" @if(Localization::getCurrentLocale() == 'id') alt="{{ $feature->title_id }}" @else alt="{{ $feature->title_en }}" @endif>
    <div class="carousel-caption">
      @if(Localization::getCurrentLocale() == 'id')
      <h3>{{ $feature->title_id }}</h3>
      <p>{{ $feature->content_id }}</p>
      @else
      <h3>{{ $feature->title_en }}</h3>
      <p>{{ $feature->content_en }}</p>
      @endif
    </div>
    </div>
    @endforeach
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#imageSlider" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#imageSlider" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>

<div class="container">
    @yield('content')
    <!-- Content -->
</div>

    @section('js')
          <script src="{{ asset('js/frontend.js') }}"></script>
    @show

  </body>
</html>
