@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="alert alert-danger">
      <h3>Apakah anda yakin akan menghapus top menu ini?</h3>
      <hr>
      <h4><b>{{ $top->nama_topmenu }}</h4>
      <hr>
      <a href="{{ $top->link_topmenu}}"><h4>{{ $top->link_topmenu }}</h4></a>
      <hr>
      <form style="display:inline-block" action="{{ route('dashboard::deleteTopMenu', $top->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <input class="btn btn-danger" type="submit" value="Delete">
      </form>
      <a href="{{ route('dashboard::topmenu') }}" class="btn btn-primary">Cancel</a>
    </div>
@stop
