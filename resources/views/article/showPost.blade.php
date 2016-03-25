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
	<div class="col-md-12">
	@if (Localization::getCurrentLocale() == 'id')
	<h4>{{ $article->title_id }}</h4>
	<p>{{ $article->content_id }}</p>
	@else
	<h4>{{ $article->title_en }}</h4>
	<p>{{ $article->content_en }}</p>
	@endif
	</div>
@stop
