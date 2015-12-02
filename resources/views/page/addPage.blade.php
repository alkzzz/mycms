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
        <label for="title_id">Judul menu utama :</label>
        <input id="title_id" class="form-control input-judul" type="text" name="title_id">
      </div>
    </div>
    <div id="en1" class="tab-pane fade in">
      <div class="form-group">
        <label for="title_en">Judul menu utama :</label>
        <input id="title_en" class="form-control input-judul" type="text" name="title_en">
      </div>
    </div>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#submenu_id">Indonesia</a></li>
  <li><a data-toggle="tab" href="#submenu_en">English</a></li>
</ul>
<div class="tab-content">
  <div id="submenu_id" class="tab-pane fade in active">
<div class="form-group input_fields_wrap">
    <div>
      <label>Judul Submenu :</label>
      <input type="text" class="form-control input-judul" name="mytext[]">
    </div>
</div>
</div>
<div id="submenu_en" class="tab-pane fade in">
<div class="form-group input_fields_wrap">
  <div>
    <label>Judul Submenu :</label>
    <input type="text" class="form-control input-judul" name="mytext[]">
  </div>
</div>
</div>
</div>
    <button class="btn btn-primary add_field_button">Tambah Submenu</button>
<hr>
<div class="alert alert-info">
    * ket: Isi dari submenu dapat ditambahkan melalui edit menu.
</div>
<div class="form-group">
    <input class="btn btn-lg btn-success" type="submit" value="Save">
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
      <label for="title_id">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id">
    </div>
    <div class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id"></textarea>
    </div>
  </div>
  <div id="en2" class="tab-pane fade">
    <div class="form-group">
      <label for="title_en">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en">
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
<script>
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div style="margin-top: 5px"><label>Judul Submenu :</label><input type="text" class="form-control input-judul" name="mytext[]"/><a style="font-size:16px" href="#" class="remove_field"><i class="fa fa-remove fa-lg fa-fw"></i>Hapus</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@endsection
