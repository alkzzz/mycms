@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
    <label>Apakah menu memiliki submenu?</label>
    <div class="radio">
      <label><input type="radio" id="has_submenu" name="has_child" value="1">Ya</label>
    </div>
    <div class="radio">
      <label><input type="radio" id="no_submenu" name="has_child" value="0">Tidak</label>
    </div>

<div id="singlemenu">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#id1">Indonesia</a></li>
    <li><a data-toggle="tab" href="#en1">English</a></li>
  </ul>
  <form role="form" action="{{ route('dashboard::storePage') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="has_child" value="1">
  <div class="tab-content">
    <div id="id1" class="tab-pane fade in active">
      <div class="form-group">
        <label for="title_id">Judul :</label>
        <input id="title_id" class="form-control" type="text" name="title_id">
      </div>
    </div>
    <div id="en1" class="tab-pane fade in">
      <div class="form-group">
        <label for="title_en">Judul :</label>
        <input id="title_en" class="form-control" type="text" name="title_en">
      </div>
    </div>
    <div class="form-group">
        <input class="btn btn-lg btn-success" type="submit" value="Save">
    </div>
</div>
</form>
</div>
<div id="hideform">
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id2">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en2">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::storePage') }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="has_child" value="0">
<div class="tab-content">
  <div id="id2" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id">Judul :</label>
      <input id="title_id" class="form-control" type="text" name="title_id">
    </div>
    <div class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id"></textarea>
    </div>
  </div>
  <div id="en2" class="tab-pane fade">
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
  $('#singlemenu').hide();
  $('#hideform').hide();
  $('input:radio[name="has_child"]').change(
      function(){
          if ($(this).is(':checked') && $(this).attr('id') == 'has_submenu') {
            $('#singlemenu').show(300);
            $('#hideform').hide(300);
          }
          else if ($(this).is(':checked') && $(this).attr('id') == 'no_submenu') {
            $('#singlemenu').hide(300);
            $('#hideform').show(300);
          }
      });
});
</script>
@endsection
