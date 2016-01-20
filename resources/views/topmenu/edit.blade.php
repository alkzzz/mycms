@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
@include('includes.alert')

<form role="form" action="{{ route('dashboard::updateTopMenu', $top->id) }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PATCH">
      <label for="title" style="display:block">Judul top menu :</label>
      <input id="title" name="nama_topmenu" value="{{ $top->nama_topmenu }}" style="margin-bottom:1%" type="text" class="form-control input-judul">
      <label for="link" style="display:block">Link top menu :</label>
      <input id="link" name="link_topmenu" value="{{ $top->link_topmenu }}" style="margin-bottom:1%" type="url" class="form-control input-judul">
      <input type="submit" class="btn btn-lg btn-success" style="display:block;margin-top:2%" value="Save">
</form>

@stop

@section('js')
@parent
<script type="text/javascript">
$(document).ready(function () {
  $("#link").change(function() {
      if (this.value.indexOf("http://") !== 0) {
          this.value = "http://" + this.value;
      }
  });
});
</script>
@stop
