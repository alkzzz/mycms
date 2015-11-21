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
    <h1>{{ $page->title_id }}</h1>
			@if($daftar_artikel)
			@foreach($daftar_artikel as $artikel)
				<a href="{{ route('show.post', [$page->slug_id, $artikel->slug_id]) }}"><h4>{{ $artikel->title_id }}</h4></a>
				<p>{{ $artikel->content_id }}</p>
			@endforeach
			@endif
    	@else
    	<h1>{{ $page->title_en }}</h1>
			@if($daftar_artikel)
				@foreach($daftar_artikel as $artikel)
				<a href="{{ route('show.post', [$page->slug_en, $artikel->slug_en]) }}"><h4>{{ $artikel->title_en }}</h4></a>
				<p>{{ $artikel->content_en }}</p>
				@endforeach
			@endif
    @endif
@stop
