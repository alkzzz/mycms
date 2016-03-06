@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
@include('includes.alert')
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en">English</a></li>
</ul>
<form role="form" action="" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">
<div class="tab-content">
  <div id="id" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id" value="{{ $post->title_id }}">
    </div>
    <div class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id">{{ $post->content_id }}</textarea>
    </div>
  </div>
  <div id="en" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $post->title_en }}">
    </div>
    <div class="form-group">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en">{{ $post->content_en }}</textarea>
    </div>
  </div>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
</form>

@stop

@section('js')
@parent
@include('includes.tinymce')
@stop
