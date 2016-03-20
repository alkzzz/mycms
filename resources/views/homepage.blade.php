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
      <img class="img-responsive" src="{{ $feature->slider->gambar }}" @if(Localization::getCurrentLocale() == 'id') alt="{{ $feature->title_id }}" @else alt="{{ $feature->title_en }}" @endif>
      <div class="carousel-caption">
        @if(Localization::getCurrentLocale() == 'id')
        <h3>
          @if ($feature->post_type == 'page')
          <a href="{{ route('show.page', $feature->slug_id) }}"
          @else
          <a href="{{ route('show.post', [$feature->category->slug_id,$feature->slug_id]) }}"
          @endif>{{ $feature->title_id }}</a></h3>
        <p class="hidden-xs">{{ $feature->content_id }}</p>
        @else
        <h3>{{ $feature->title_en }}</h3>
        <p class="hidden-xs">{{ $feature->content_en }}</p>
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
  <hr>
@endsection

@section('content')

@foreach($kategori as $kategori)
@if(Localization::getCurrentLocale() == 'id')
  <div class="col-md-4">
  <h4> <a href="{{ route('show.page', $kategori->slug_id) }}" class="kategori">{{ $kategori->title_id }}</a></h4>
    <?php $i = 0; ?>
    @foreach($kategori->articles as $post)
      <div class="panel panel-default">
      <div class="panel-heading">{{ $post->title_id }}</div>
        <div class="panel-body">{{ $post->content_id }}
        <br>
        <a href="{{ route('show.post', [$kategori->slug_id,$post->slug_id]) }}" class="btn btn-sm btn-primary">{{ trans('trans.readmore') }}</a>
        </div>
      </div>
      <?php $i++ ?>
      @if($i == 3)
        <?php break; ?>
      @endif
    @endforeach
  </div>
@else
<div class="col-md-4">
  <h4> <a href="{{ route('show.page', $kategori->slug_en) }}" class="kategori">{{ $kategori->title_en }}</a></h4>
      <?php $i = 0; ?>
      @foreach($kategori->articles as $post)
        <div class="panel panel-default">
        <div class="panel-heading">{{ $post->title_en }}</div>
          <div class="panel-body">{{ $post->content_en }}
          <br>
          <a href="{{ route('show.post', [$kategori->slug_en,$post->slug_en]) }}" class="btn btn-sm btn-primary">{{ trans('trans.readmore') }}</a>
          </div>
        </div>
        <?php $i++ ?>
        @if($i == 3)
          <?php break; ?>
        @endif
      @endforeach
  </div>
@endif

@endforeach

@endsection
