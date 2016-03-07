@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
@include('includes.alert')

@if($page->has_child == 1)
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id1">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en1">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::updatePage', $page->id) }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">
<div class="tab-content">
  <div id="id1" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id" value="{{ $page->title_id }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_id)
    <div class="form-group">
      <label for="title_id" style="display: block">Judul submenu :</label>
      <input disabled id="title_id" class="form-control input-judul" type="text" name="title_id[]" value="{{ $submenu_id->title_id }}">
    </div>
    @endforeach
    @endif
    <a href="{{ route('dashboard::addSubmenu', $page->id) }}" class="btn btn-primary">Tambah Submenu</a>
  </div>
  <div id="en1" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $page->title_en }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_en)
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul submenu :</label>
      <input disabled id="title_en" class="form-control input-judul" type="text" name="title_en[]" value="{{ $submenu_en->title_en }}">
    </div>
    @endforeach
    @endif
    <a href="{{ route('dashboard::addSubmenu', $page->id) }}" class="btn btn-primary">Tambah Submenu</a>
  </div>
  <hr>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
  </form>
@else
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id2">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en2">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::updatePage', $page->id) }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">
<div class="tab-content">
  <div id="id2" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id" value="{{ $page->title_id }}">
    </div>
    <div class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id">{{ $page->content_id }}</textarea>
    </div>
  </div>
  <div id="en2" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $page->title_en }}">
    </div>
    <div class="form-group">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en">{{ $page->content_en }}</textarea>
    </div>
  </div>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
  </form>
@endif

@stop

@section('js')
@parent
@include('includes.tinymce')
@stop
