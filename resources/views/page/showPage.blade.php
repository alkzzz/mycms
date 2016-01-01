@extends('_layouts.base')

@if (Localization::getCurrentLocale() == 'id')
	@section('title', $page->title_id)
@else
	@section('title', $page->title_en)
@endif


@section('lang')
	@if (Localization::getCurrentLocale() == 'id')
	<li><a href="{{ url('en'.'/'.$page->slug_en) }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
	@else
	<li><a href="{{ url('id'.'/'.$page->slug_id) }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
	@endif
@stop

@section('lang-mobile')
	@if (Localization::getCurrentLocale() == 'id')
	<li class="visible-xs"><a href="{{ url('en'.'/'.$page->slug_en) }}"><img src="{{ asset('img/english.png') }}" alt="EN"></a></li>
	@else
	<li class="visible-xs"><a href="{{ url('id'.'/'.$page->slug_id) }}"><img src="{{ asset('img/indonesia.png') }}" alt="ID"></a></li>
	@endif
@stop

@section('content')
	@if (Localization::getCurrentLocale() == 'id')
	<h3>{{ $page->title_id }}</h3>
	<article>{!! $page->content_id !!} </article>
	@else
	<h3>{{ $page->title_en }}</h3>
	<article>{!! $page->content_en !!} </article>
	@endif
@stop
