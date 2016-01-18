@extends('_layouts.dashboard')

@section('title', $title)

@section('content')

<form role="form" action="{{ route('dashboard::storeTopMenu') }}" method="POST">
      {{ csrf_field() }}
      <label for="title" style="display:block">Judul top menu :</label>
      <input id="title" style="margin-bottom:1%" type="text" class="form-control input-judul">
      <label for="link" style="display:block">Link top menu :</label>
      <input id="link" style="margin-bottom:1%" type="url" class="form-control input-judul">
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
