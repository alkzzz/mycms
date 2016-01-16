@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
@include('includes.alert')

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id1">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en1">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::storeSubmenu', $page->slug_id) }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="has_child" value="1">
<div class="tab-content">
  <div id="id1" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input disabled id="title_id" class="form-control input-judul" type="text" name="title_id[]" value="{{ $page->title_id }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_id)
    <div class="form-group">
      <label for="title_id" style="display: block">Judul submenu :</label>
      <input disabled id="title_id" class="form-control input-judul" type="text" name="title_id[]" value="{{ $submenu_id->title_id }}">
    </div>
    @endforeach
    @endif
    <div id="input_fields_id" class="form-group">
      <div>
      <label style="display: block">Judul Submenu :</label>
      <input type="text" class="form-control input-judul" name="title_id[]" autofocus>
      </div>
    </div>
    <button id="add_field_button_id" class="btn btn-primary">Tambah Submenu</button>
  </div>
  <div id="en1" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input disabled id="title_en" class="form-control input-judul" type="text" name="title_en[]" value="{{ $page->title_en }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_en)
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul submenu :</label>
      <input disabled id="title_en" class="form-control input-judul" type="text" name="title_en[]" value="{{ $submenu_en->title_en }}">
    </div>
    @endforeach
    @endif
    <div id="input_fields_en" class="form-group">
      <div>
        <label style="display: block">Judul Submenu :</label>
        <input type="text" class="form-control input-judul" name="title_en[]" autofocus>
      </div>
    </div>
    <button id="add_field_button_en" class="btn btn-primary">Tambah Submenu</button>
  </div>
  <hr>
  <div class="alert alert-info">
      * ket: Isi dari submenu dapat ditambahkan melalui edit menu.
  </div>
  <hr>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
  </form>

@stop

@section('js')
@parent
<script>
$(document).ready(function() {
    var max_fields      = 10;
    var wrapper_id         = $("#input_fields_id");
    var wrapper_en         = $("#input_fields_en");
    var add_button_id      = $("#add_field_button_id");
    var add_button_en      = $("#add_field_button_en");

    var x = 1;
    $(add_button_id).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper_id).append('<div style="margin-top: 5px"><label style="display:block">Judul Submenu :</label><input type="text" class="form-control input-judul" name="title_id[]"/><a style="font-size:16px" href="#" class="remove_field"><i class="fa fa-remove fa-lg fa-fw"></i>Hapus</a></div>');
        }
    });
    $(add_button_en).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper_en).append('<div style="margin-top: 5px"><label style="display:block">Judul Submenu :</label><input type="text" class="form-control input-judul" name="title_en[]"/><a style="font-size:16px" href="#" class="remove_field"><i class="fa fa-remove fa-lg fa-fw"></i>Hapus</a></div>');
        }
    });

    $(wrapper_id).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

    $(wrapper_en).on("click",".remove_field", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@stop
