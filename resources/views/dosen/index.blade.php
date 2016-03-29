@extends('_layouts.base')

@if (Localization::getCurrentLocale() == 'id')
	@section('title', 'Dosen')
@else
	@section('title', 'Lecture')
@endif


@section('content')
	<div class="col-md-12">
    <h1>Hai {!! trans('trans.dosen') !!}</h1>
	</div>
@stop
