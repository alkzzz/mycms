@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="alert alert-danger">
      <h3>Apakah anda yakin akan menghapus artikel ini dari slideshow halaman utama?</h3>
      <hr>
      <h4><b>{{ $post->title_id }} / {{ $post->title_en }}</b></h4>
      <hr>
      <img src="{{ $post->slider->thumbnail }}" />
      <hr>
      <form style="display:inline-block" action="{{ route('dashboard::removeSlider', $post->id_gambar) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PATCH">
        <input class="btn btn-danger" type="submit" value="Delete">
      </form>
      <a href="{{ route('dashboard::slider') }}" class="btn btn-primary">Cancel</a>
    </div>
@stop
