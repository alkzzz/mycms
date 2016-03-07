@extends('_layouts.base')

@section('title', $title)

@section('content')
@if(Localization::getCurrentLocale()=='id')
  <h4>Hasil pencarian untuk <strong>'{{ $query }}'<strong></h4>
    <h5>Ditemukan {{ count($results) }} hasil</h5>
  <ul>
    @foreach($results as $result)
    <li>{{ $result->title_id }}</li>
    @endforeach
  </ul>
@else
  <h4>Search results for <strong>'{{ $query }}'<strong></h4>
    <h5>{{ count($results) }} results found</h5>
  <ul>
    @foreach($results as $result)
    <li>{{ $result->title_en }}</li>
    @endforeach
  </ul>
@endif
@endsection
