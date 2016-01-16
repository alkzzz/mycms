@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
    <div class="alert alert-danger">
      <h3>Apakah anda yakin akan menghapus menu ini?</h3>
      <hr>
      <h4><b>{{ $page->title_id }} / {{ $page->title_en }}</b></h4>
      @if(count($submenu))
      <hr>
      <h3>Anda juga akan menghapus submenu yang termasuk didalamnya:</h3>
      @foreach($submenu as $submenu)
      <h4><b>{{ $submenu->title_id }} / {{ $submenu->title_en }}</b></h4>
      @endforeach
      @endif
      <hr>
      <form style="display:inline-block" action="{{ route('dashboard::deletePage', $page->slug_id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
        <input class="btn btn-danger" type="submit" value="Delete">
      </form>
      <a href="{{ route('dashboard::menu') }}" class="btn btn-primary">Cancel</a>
    </div>
@stop
