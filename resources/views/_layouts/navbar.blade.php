<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('homepage') }}">Teknik Informatika</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="mobile-menu">
        <ul class="nav navbar-nav navbar-right">
            @section('lang')
            @if (Localization::getCurrentLocale() == 'id')
            <li><a href="{{Localization::getLocalizedURL('en') }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
            @else
            <li><a href="{{Localization::getLocalizedURL('id') }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
            @endif

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
