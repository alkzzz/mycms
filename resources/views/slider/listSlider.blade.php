@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/lightbox/css/lightbox.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('content')
@include('includes.alert')
<a href="{{ route('dashboard::addSlider') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
<hr>
@if(!count($sliders))
<h3>Website belum memiliki slider. Silahkan tambahkan slider dengan mengklik tombol <b>Tambah</b>.</h3>
@else
  <div class="row">
  <h3 class="col-md-3 col-xs-12 topmenu-title">Gambar</h3>
  <h3 class="col-md-3 col-xs-12 topmenu-title">Judul (ID)</h3>
  <h3 class="col-md-3 col-xs-12 topmenu-title">Judul (EN)</h3>
  </div>
  <ul id="sortable" class="default" style="padding-left:0px">
    @foreach($sliders as $slider)
        <li id="slider_{{ $slider->id }}">
          <div class="row">
          <div style="margin-bottom:2%" class="col-md-3 col-xs-12 topmenu-list">
              <a href="{{ $slider->gambar }}" data-lightbox="image-{{ $slider->id }}" data-title="{{ $slider->title_id }}"><img style="width:200px;height:100px" src="{{ $slider->gambar }}" /></a>
          </div>
          <div class="col-md-3 col-xs-12" style="margin-top:0.5em">
              <p>{{ $slider->title_id }}</p>
          </div>
          <div class="col-md-3 col-xs-12" style="margin-top:0.5em">
              <p>{{ $slider->title_en }}</p>
          </div>
          <div style="padding-top:1em;padding-bottom:2em" class="col-md-3 col-xs-12">
              @if ($slider->post_type == 'page')
              <a style="margin-bottom:0.5em" href="{{ route('dashboard::editPage', $slider->pid) }}" class="btn btn-warning">Edit <i class="fa fa-edit fa-fw"></i></a>
              @else
              <a style="margin-bottom:0.5em" href="{{ route('dashboard::editPost', $slider->pid) }}" class="btn btn-warning">Edit <i class="fa fa-edit fa-fw"></i></a>
              @endif
              <a style="margin-bottom:0.5em" href="{{ route('dashboard::showRemoveSlider', $slider->pid) }}" class="btn btn-danger">Delete <i class="fa fa-trash fa-fw"></i></a>
           </div>
          </div>
        </li>
    @endforeach
  </ul>
<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%;margin-bottom:10%">Urutkan Slider</button>
@endif
@stop

@section('js')
@parent
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('css/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
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
        swal({title:'Sukses',text: 'Slideshow Berhasil Diurutkan', type: 'success',   confirmButtonText: 'OK' });
      })
      .fail(function() {
        swal({title:'Gagal',text: 'Slideshow Gagal Diurutkan', type: 'error',   confirmButtonText: 'OK' });
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
