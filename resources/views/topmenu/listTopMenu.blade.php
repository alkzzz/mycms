@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('content')
@include('includes.alert')
<a href="{{ route('dashboard::addTopMenu') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
<hr>
@if(!count($topmenu))
<h3>Website belum memiliki top menu. Silahkan tambahkan top menu dengan mengklik tombol <b>Tambah</b>.</h3>
@else
  <div class="row">
  <h3 class="topmenu-title col-md-4 col-xs-12">Nama Menu</h3>
  <h3 class="topmenu-title col-md-4 col-xs-12">Link Menu</h3>
  </div>
  <ul id="sortable" class="parent-menu default" style="padding-left:0px">
    @foreach($topmenu as $top)
        <li id="topmenu_{{ $top->id }}">
          <div class="row">
          <div class="topmenu-list col-md-4 col-xs-12">
              {{ $top->nama_topmenu }}
          </div>
          <div class="topmenu-list col-md-4 col-xs-12">
              <a href="{{ $top->link_topmenu }}" style="color:#333" target="_blank">{{ $top->link_topmenu }}</a>
          </div>
          <div class="col-md-4 col-xs-12" style="margin-bottom:1em">
            <a href="{{ route('dashboard::editTopMenu', $top->id) }}" class="btn btn-warning">Edit <i class="fa fa-edit fa-fw"></i></a>
             <a href="{{ route('dashboard::showDeleteTopMenu', $top->id) }}" class="btn btn-danger">Delete <i class="fa fa-trash fa-fw"></i></a>
          </div>
        </li>
    @endforeach
  </ul>
</div>
<hr>
<button id="urut" type="button" class="btn btn-primary">Urutkan Menu</button>

@endif
@stop

@section('js')
@parent
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#urut').click(function() {
    if ($('#urut').text() == "Save") {

      var urutan = $('#sortable').sortable("serialize");

      $('#sortable').sortable({
        containment: "#contain",
        disabled : true
      });

      $.ajax({
        url: "{{ route('dashboard::urutTopMenu')}}",
        type: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: { urutan: urutan },
      })
      .done(function() {
        swal({title:'Sukses',text: 'Menu Berhasil Diurutkan', type: 'success',   confirmButtonText: 'OK' });
      })
      .fail(function() {
        swal({title:'Gagal',text: 'Menu Gagal Diurutkan', type: 'error',   confirmButtonText: 'OK' });
      });

      $('#urut').text("Urutkan");

    }
    else {
       $('#sortable').sortable({
              disabled : false,
              placeholder: "highlight",
              opacity: 0.8,
          });
       $('#sortable').disableSelection();
      ($('#urut').text("Save"));
    }
  });
});
</script>
@endsection
