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
<form role="form" action="{{ route('dashboard::updatePage', $page->id) }}" method="POST">
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
        <label><input id="check_id" type="checkbox" name="check_link" @if($page->link_id) checked @endif>Custom Link</label>
      </div>
      <div id="link_id">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_id" value="{{ $page->link_id }}">
      </div>
    </div>
    <div id="text_id" class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id">{{ $page->content_id }}</textarea>
      <br>
      <div class="form-group">
      <label><input class="tampilkan" name="featured" type="checkbox" value="1"> Tampilkan di slideshow?</label>
      <br>
      <div class="form-group pilihgambar" style="display:none">
      <input class="preview" name="gambar" type="file">
      <img style="width:200px;height:100px" class="img" src="" alt="Tidak ada gambar"/>
      <p>Preview</p>
      <button class="btn btn-sm btn-danger cleargambar">Clear</button>
      <p>*Gambar yang diupload akan diresize sesuai ukuran slider</strong></p>
      </div>
      </div>
    </div>
  </div>
  <div id="en2" class="tab-pane fade in">
    <div class="form-group">
      <label for="title_en"  style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en" value="{{ $page->title_en }}">
    </div>
    <div class="form-group">
      <div class="checkbox" style="display:inline-block">
        <label><input id="check_en" type="checkbox" name="check_link" @if($page->link_en) checked @endif>Custom Link</label>
      </div>
      <div id="link_en">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_en" value="{{ $page->link_en }}">
      </div>
    </div>
    <div id="text_en" class="form-group">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en">{{ $page->content_en }}</textarea>
      <br>
      <div class="form-group">
      <label><input class="tampilkan" name="featured" type="checkbox" value="1"> Tampilkan di slideshow?</label>
      <br>
      <div class="form-group pilihgambar" style="display:none">
      <input class="preview" name="gambar" type="file">
      <img style="width:200px;height:100px" class="img" src="" alt="Tidak ada gambar"/>
      <p>Preview</p>
      <button class="btn btn-sm btn-danger cleargambar">Clear</button>
      <p>*Gambar yang diupload akan diresize sesuai ukuran slider</strong></p>
      </div>
      </div>
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
    if ($('#check_id').is(':checked')) {
    $('#text_id').hide();
    }
    else {
    $('#link_id').hide();
    }
    $('input:checkbox[id="check_id"]').change(
        function(){
            if ($(this).is(':checked')) {
              $('#link_id').fadeToggle( "slow", "linear" );
              $('#text_id').fadeToggle( "slow", "linear" );
            }
            else {
              $('#link_id').fadeToggle( "slow", "linear" );
              $('#text_id').fadeToggle( "slow", "linear" );
            }
        });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    if ($('#check_en').is(':checked')) {
    $('#text_en').hide();
    }
    else {
    $('#link_en').hide();
    }
    $('input:checkbox[id="check_en"]').change(
        function(){
            if ($(this).is(':checked')) {
              $('#link_en').fadeToggle( "slow", "linear" );
              $('#text_en').fadeToggle( "slow", "linear" );
            }
            else {
              $('#link_en').fadeToggle( "slow", "linear" );
              $('#text_en').fadeToggle( "slow", "linear" );
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
$(document).ready(function(){
    $('input[class="tampilkan"]').click(function(){
      if ($(this).is(":checked"))
      {
        $(".pilihgambar").show();
        $(".tampilkan").prop('checked', true);
      }
      else
      {
        $(".pilihgambar").hide();
        $(".tampilkan").prop('checked', false);
        $('.img').attr('src', '');
        $('.preview').val('');
      }
});
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.cleargambar').on('click', function(e) {
      e.preventDefault();
      $('.img').attr('src', '');
      $('.preview').val('');
    });
    });
</script>

<script type="text/javascript">
$(document).ready(function() {
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  $(".preview").change(function(){
    readURL(this);
  });
});
</script>
@stop
