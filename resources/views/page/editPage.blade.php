@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
@include('includes.alert')
@if($page->has_child == 1)
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id1">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en1">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::updatePage', $page->id) }}" method="POST">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">
<div class="tab-content">
  <div id="id1" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id" value="{{ $page->title_id }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_id)
    <div class="form-group">
      <label for="title_id" style="display: block">Judul submenu :</label>
      <input disabled id="title_id" class="form-control input-judul" type="text" name="title_id[]" value="{{ $submenu_id->title_id }}">
    </div>
    @endforeach
    @endif
    <a href="{{ route('dashboard::addSubmenu', $page->id) }}" class="btn btn-primary">Tambah Submenu</a>
  </div>
  <div id="en1" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $page->title_en }}">
    </div>
    @if(count($submenu))
    @foreach($submenu as $submenu_en)
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul submenu :</label>
      <input disabled id="title_en" class="form-control input-judul" type="text" name="title_en[]" value="{{ $submenu_en->title_en }}">
    </div>
    @endforeach
    @endif
    <a href="{{ route('dashboard::addSubmenu', $page->id) }}" class="btn btn-primary">Tambah Submenu</a>
  </div>
  <hr>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
  </form>
@else
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#id2">Indonesia</a></li>
  <li><a data-toggle="tab" href="#en2">English</a></li>
</ul>
<form role="form" action="{{ route('dashboard::updatePage', $page->id) }}" method="POST" enctype="multipart/form-data">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="PATCH">
<div class="tab-content">
  <div id="id2" class="tab-pane fade in active">
    <div class="form-group">
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id" value="{{ $page->title_id }}">
    </div>
    <div class="form-group">
      <div class="checkbox" style="display:inline-block">
        <label><input class="custom-link" type="checkbox" name="check_link" value="1" @if($page->link_id) checked @endif>Custom Link</label>
      </div>
      <div class="div-link">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_id" value="{{ $page->link_id }}">
      </div>
    </div>
    <div class="form-group text">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id">{{ $page->content_id }}</textarea>
    </div>
  </div>
  <div id="en2" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $page->title_en }}">
    </div>
    <div class="form-group">
      <div class="checkbox" style="display:inline-block">
        <label><input class="custom-link" type="checkbox" name="check_link" @if($page->link_en) checked @endif>Custom Link</label>
      </div>
      <div class="div-link">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_en" value="{{ $page->link_en }}">
      </div>
    </div>
    <div class="form-group text">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en">{{ $page->content_en }}</textarea>
    </div>
  </div>
</div>
  <br>
  <div id="feature" class="form-group">
  <label><input id="tampilkan" name="featured" value="1" type="checkbox" @if($page->slider) checked @endif> Tampilkan di slideshow?</label>
  <br>
  <div id="pilihgambar" class="form-group" @if(!$page->slider) style="display:none" @endif>
  <input id="preview" name="gambar" type="file">
  <img style="width:200px;height:100px" id="img" @if($page->slider) src="{{ $page->slider->gambar }}" @else src="" alt="Tidak ada gambar" @endif/>
  <p>Preview</p>
  <button id="clear" class="btn btn-sm btn-danger">Clear</button>
  <p>*Gambar yang diupload akan diresize sesuai ukuran slider</strong></p>
  </div>
  </div>
  <div class="form-group">
      <input class="btn btn-lg btn-success" type="submit" value="Save">
  </div>
  </form>
@endif

@stop

@section('js')
@parent
@include('includes.tinymce')
<script type="text/javascript">
  $(document).ready(function() {
    if ($('.custom-link').is(':checked')) {
    $('.text').hide();
    $('#feature').hide();
    }
    else {
    $('.div-link').hide();
    }
    $('input:checkbox[class="custom-link"]').change(
        function(){
            if ($(this).is(':checked')) {
              $('.div-link').fadeToggle( "slow", "linear" );
              $('.text').fadeToggle( "slow", "linear" );
              $('#feature').fadeToggle( "slow", "linear" );
              $('.custom-link').prop('checked', true);
            }
            else {
              $('.div-link').fadeToggle( "slow", "linear" );
              $('.text').fadeToggle( "slow", "linear" );
              $('#feature').fadeToggle( "slow", "linear" );
              $('.link').val('');
              $('.custom-link').prop('checked', false);
            }
        });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  $(".link").change(function() {
      if (this.value.indexOf("http://") !== 0) {
          this.value = "http://" + this.value;
      }
  });
});
</script>
<script type="text/javascript">
    $('input[id="tampilkan"]').click(function(){
      if ($(this).is(":checked"))
      {
        $("#pilihgambar").show();
        $("#tampilkan").prop('checked', true);
      }
      else
      {
        $("#pilihgambar").hide();
        $("#tampilkan").prop('checked', false);
        $('#img').attr('src', '');
        $('#preview').val('');
      }
});
</script>
<script type="text/javascript">
      $('#clear').on('click', function(e) {
      e.preventDefault();
      $('#img').attr('src', '');
      $('#preview').val('');
    });
</script>

<script type="text/javascript">
$(document).ready(function() {
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  $("#preview").change(function(){
    readURL(this);
  });
});
</script>
@stop
