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
	<p>{{ Str::words($page->content_id, 10) }} <a href="{{ route('show.page', $page->slug_id) }}">Read More</a></p>
	@else
	<h3>{{ $page->title_en }}</h3>
	<p>{{ Str::words($page->content_en, 10) }} <a href="{{ route('show.page', $page->slug_en) }}">Read More</a></p>
	@endif
@stop
