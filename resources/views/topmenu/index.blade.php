@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('content')
<a href="{{ route('dashboard::addTopMenu') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
<hr>
@if(!count($topmenu))
<h3>Website belum memiliki top menu. Silahkan tambahkan top menu dengan mengklik tombol <b>Tambah</b>.</h3>
@else
<div style="display:inline-block" class="pull-left">
  <h3 class="topmenu-title">Nama Menu</h3>
  <ul class="parent-menu default">
    @foreach($topmenu as $top)
        <li class="topmenu-list">{{ $top->nama }}</li>
    @endforeach
  </ul>
</div>
<div style="display:inline-block;margin-left:20%" class="pull-left">
  <h3 class="topmenu-title">Link Menu</h3>
  <ul class="parent-menu default">
      @foreach($topmenu as $menu)
        <li class="topmenu-list">{{ $menu->link }}</li>
      @endforeach
  </ul>
</div>
<hr style="clear:left">
<button id="urut" type="button" class="btn btn-primary">Urutkan Menu</button>
@endif
@stop
