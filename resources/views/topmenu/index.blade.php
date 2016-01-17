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
  <h3 class="topmenu-title" style="width:30%">Nama Menu</h3>
  <h3 class="topmenu-title">Link Menu</h3>
  <ul class="parent-menu default">
    @foreach($topmenu as $top)
        <li>
          <div class="topmenu-list" style="width:30%" >
              {{ $top->nama }}
          </div>
          <div class="topmenu-list">
              {{ $top->link }}
          </div>
        </li>
    @endforeach
  </ul>
</div>
<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%">Urutkan Menu</button>
@endif
@stop
