@extends('_layouts.dashboard')

@section('title', $title)

@section('content')

    @include('includes.alert')

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
        <label for="title_id" style="display: block">Judul menu utama :</label>
        <input id="title_id" class="form-control input-judul" type="text" name="title_id[]">
        </div>
      <div id="submenu_id" class="tab-pane fade in active">
        <div id="input_fields_id" class="form-group">
      <div>
        <label style="display: block">Judul Submenu :</label>
        <input type="text" class="form-control input-judul" name="title_id[]">
      </div>
      </div>
      <button id="add_field_button_id" class="btn btn-primary">Tambah Submenu</button>
      </div>
    </div>
    <div id="en1" class="tab-pane fade in">
      <div class="form-group">
        <label for="title_en"  style="display: block">Judul menu utama :</label>
        <input id="title_en" class="form-control input-judul" type="text" name="title_en[]">
      </div>
      <div id="submenu_en" class="tab-pane fade in">
      <div id="input_fields_en" class="form-group">
        <div>
          <label style="display: block">Judul Submenu :</label>
          <input type="text" class="form-control input-judul" name="title_en[]">
        </div>
      </div>
      <button id="add_field_button_en" class="btn btn-primary">Tambah Submenu</button>
      </div>
    </div>
</div>
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
      <label for="title_id" style="display: block">Judul menu utama :</label>
      <input id="title_id" class="form-control input-judul" type="text" name="title_id">
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label><input id="check_id" type="checkbox" name="check_link">Custom Link</label>
      </div>
      <div id="link_id">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_id">
      </div>
    </div>
    <div id="text_id" class="form-group">
      <label for="edittext_id">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_id" name="content_id"></textarea>
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
  <div id="en2" class="tab-pane fade">
    <div class="form-group">
      <label for="title_en" style="display: block">Judul menu utama :</label>
      <input id="title_en" class="form-control input-judul" type="text" name="title_en">
    </div>
    <div class="form-group">
      <div class="checkbox">
        <label><input id="check_en" type="checkbox" name="check_link">Custom Link</label>
      </div>
      <div id="link_en">
        <label style="display: block">Link :</label>
        <input class="form-control input-judul link" type="text" name="link_en">
      </div>
    </div>
    <div id="text_en" class="form-group">
      <label for="edittext_en">Isi Halaman Menu :</label>
      <textarea class="form-control" id="edittext_en" name="content_en"></textarea>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#link_id').hide();
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
    $('#link_en').hide();
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
@endsection
