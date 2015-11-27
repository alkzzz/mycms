@extends('_layouts.base')

@if (Localization::getCurrentLocale() == 'id')
	@section('title', $article->title_id)
@else
	@section('title', $article->title_en)
@endif


@section('lang')
@if (Localization::getCurrentLocale() == 'id')
<li><a href="{{ url('en'.'/'.$kat->slug_en.'/'.$article->slug_en) }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
@else
<li><a href="{{ url('id'.'/'.$kat->slug_id.'/'.$article->slug_id) }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
@endif
@stop

@section('lang-mobile')
@if (Localization::getCurrentLocale() == 'id')
<li class="visible-xs"><a href="{{ url('en'.'/'.$article->slug_en) }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
@else
<li class="visible-xs"><a href="{{ url('id'.'/'.$article->slug_id) }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
@endif
@stop

@section('content')
	@if (Localization::getCurrentLocale() == 'id')
	<h3>{{ $article->title_id }}</h3>
	<p>{{ Str::words($article->content_id, 10) }} <a href="#">Read More</a></p>
	@else
	<h3>{{ $article->title_en }}</h3>
	<p>{{ Str::words($article->content_en, 10) }} <a href="#">Read More</a></p>
	@endif
@stop
