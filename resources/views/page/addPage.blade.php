@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
<button type="button" id="sembunyi">Hide</button>

<div id="hide">
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::storePage') }}" method="POST">
  {{ csrf_field() }}
<div class="tab-content">
  <div id="id" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id">Judul :</label>
      <input id="title_id" class="form-control" type="text" name="title_id">
    </div>
    <div class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id"></textarea>
    </div>
  </div>
  <div id="en" class="tab-pane fade">
    <div class="form-group">
      <label for="title_en">Judul :</label>
      <input id="title_en" class="form-control" type="text" name="title_en">
    </div>
    <div class="form-group">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en"></textarea>
    </div>
  </div>
</div>

  <div class="form-group">
    <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
</form>
</div>

@stop

@section('js')
@parent
@include('includes.tinymce')
<script type="text/javascript">
$(document).ready(function() {
  $("#sembunyi").click(function(){
    $("#hide").toggle();
  });
});
</script>
@endsection
