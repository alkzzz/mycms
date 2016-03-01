@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
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
  <h3 class="col-lg-2 topmenu-title">Judul Indonesia</h3>
  <h3 class="col-lg-2 topmenu-title">Judul English</h3>
  <ul id="sortable" class="parent-menu default">
    @foreach($sliders as $slider)
        <li id="slider_{{ $slider->id }}">
          <div class="row">
          <div class="col-lg-4 topmenu-list">
              <a href="{{ $slider->gambar }}" data-lightbox="image-{{ $slider->id }}" data-title="{{ $slider->title_id }}"><img src="{{ $slider->thumbnail }}" /></a>
          </div>
          <div class="col-lg-2 topmenu-list">
              <h4> {{ $slider->content_id }} </h4>
          </div>
          <div class="col-lg-2 topmenu-list">
              <h4> {{ $slider->content_en }} </h4>
          </div>
          <div style="padding-top:1em" class="col-lg-2">
              <a href="#" class="btn btn-warning">Edit <i class="fa fa-edit fa-fw"></i></a>
              <a style="margin-left:1em" href="{{ route('dashboard::showRemoveSlider', $slider->id) }}" class="btn btn-danger">Delete <i class="fa fa-trash fa-fw"></i></a>
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
