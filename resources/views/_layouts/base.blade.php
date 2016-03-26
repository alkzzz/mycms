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
    <div class="row">
  <div id="top-menu" class="hidden-xs">
  <ul class="list-inline navbar-left">
    @include('_layouts.topmenu')
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
  </div>
      <!-- Main Menu -->
    <nav class="navbar navbar-default">
    <div class="container">
      <div class="row">
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
      <ul class="nav navbar-nav navbar-right hidden-xs">
          @section('lang-mobile')
          @if (Localization::getCurrentLocale() == 'id')
          <li class="visible-xs"><a href="{{Localization::getLocalizedURL('en') }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
          @else
          <li class="visible-xs"><a href="{{Localization::getLocalizedURL('id') }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
          @endif
          @show
          @include('_layouts.dropdown', ['items'=> $menu_mainmenu->roots()])
      </ul>
        <ul class="nav navbar-nav navbar-right visible-xs">
            @section('lang-mobile')
            @if (Localization::getCurrentLocale() == 'id')
            <li><a href="{{Localization::getLocalizedURL('en') }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
            @else
            <li><a href="{{Localization::getLocalizedURL('id') }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
            @endif
            @show
            @include('_layouts.dropdown', ['items'=> $menu_mainmenu->roots()])
            <hr>
            @include('_layouts.topmenu')
        </ul>
        <form class="navbar-form navbar-right visible-xs" role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
        </form>
      </div><!-- /.navbar-collapse -->
    </div>
  </div>
  </nav>

<div class="container">
  <div class="row">
    @yield('slider')
  </div>
</div>


<div class="container" id=maincontent>
    <div class="row" style="margin-bottom:5%">
      <!-- Content -->
    @yield('content')
    </div>
</div>

<footer class="footer-distributed">
  <div class="footer-left">
    <h3>Company<span>logo</span></h3>
    <p class="footer-links">
      <a href="#">Home</a>
      ·
      <a href="#">Blog</a>
      ·
      <a href="#">Pricing</a>
      ·
      <a href="#">About</a>
      ·
      <a href="#">Faq</a>
      ·
      <a href="#">Contact</a>
    </p>
    <p class="footer-company-name">Company Name &copy; 2015</p>
  </div>
  <div class="footer-center">
    <div>
      <i class="fa fa-map-marker"></i>
      <p><span>21 Revolution Street</span> Paris, France</p>
    </div>
    <div>
      <i class="fa fa-phone"></i>
      <p>+1 555 123456</p>
    </div>
    <div>
      <i class="fa fa-envelope"></i>
      <p><a href="mailto:support@company.com">support@company.com</a></p>
    </div>
  </div>
  <div class="footer-right">
    <p class="footer-company-about">
      <span>About the company</span>
      Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
    </p>
    <div class="footer-icons">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-github"></i></a>
    </div>
  </div>
</footer>

@section('js')
      <script src="{{ asset('js/frontend.js') }}"></script>
@show

  </body>
</html>
