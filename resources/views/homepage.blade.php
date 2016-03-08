@extends('_layouts.base')

@section('title', $title)

@section('slider')
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
@endsection
