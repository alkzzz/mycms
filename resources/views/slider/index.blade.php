@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox/css/lightbox.min.css') }}">
@stop

@section('content')
@include('includes.alert')
<a href="{{ route('dashboard::addSlider') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
<hr>
@if(!count($sliders))
<h3>Website belum memiliki slider. Silahkan tambahkan slider dengan mengklik tombol <b>Tambah</b>.</h3>
@else
  <h3 class="col-lg-4 topmenu-title">Gambar Slideshow</h3>
  <h3 class="col-lg-5 topmenu-title">Judul Artikel</h3>
  <ul id="sortable" class="parent-menu default">
    @foreach($sliders as $slider)
        <li id="slider_{{ $slider->id }}">
          <div class="row">
          <div class="col-lg-4 topmenu-list">
              <a href="{{ $slider->gambar }}" data-lightbox="image-{{ $slider->id }}" data-title="{{ $slider->title_id }}"><img src="{{ $slider->thumbnail }}" /></a>
          </div>
          <div style="margin-top:2em" class="col-lg-5 topmenu-list">
              <h4> {{ $slider->title_id }} </h4>
          </div>
          <div style="margin-top:2em" class="col-lg-2">
            <form style="margin:0;padding:0" id="formDelete" action="{{ route('dashboard::deleteTopMenu', $slider->id) }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <input id="delete" class="btn btn-danger" type="submit" value="Delete">
              <a style="margin-left:1em" href="#" class="btn btn-warning">Edit <i class="fa fa-edit fa-fw"></i></a>
            </form>
           </div>
           </div>
        </li>
    @endforeach
  </ul>
</div>
<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%">Urutkan Slider</button>
@endif
@stop

@section('js')
@parent
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('css/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"> </script>
<script type="text/javascript">
$('input#delete').on('click', function(e){
  e.preventDefault();
  swal({
    title: "Are you sure?",
    text: "Anda yakin akan menghapus artikel ini dari slideshow?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Delete",
    closeOnConfirm: false
  },
    function(){
    $("#formDelete").submit();
    swal('Delete','Artikel tidak ditampilkan lagi di slideshow.','success');
  });
})
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#urut').click(function() {
    if ($('#urut').text() == "Save") {

      var urutan = $('#sortable').sortable("serialize");

      $('#sortable').sortable({
        disabled : true
      });

      $.ajax({
        url: "{{ route('dashboard::urutSlider')}}",
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { urutan: urutan },
      })
      .done(function() {
        swal({title:'Sukses',text: 'Slider Berhasil Diurutkan', type: 'success',   confirmButtonText: 'OK' });
      })
      .fail(function() {
        swal({title:'Gagal',text: 'Slider Gagal Diurutkan', type: 'error',   confirmButtonText: 'OK' });
      });

      $('#urut').text("Urutkan");

    }
    else {
       $('#sortable').sortable({
              disabled : false,
              placeholder: "slide-highlight",
              opacity: 0.8,
          });
       $('#sortable').disableSelection();
      ($('#urut').text("Save"));
    }
  });
});
</script>

@endsection
