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
  <h3 class="topmenu-title" style="width:30%">Nama Menu</h3>
  <h3 class="topmenu-title">Link Menu</h3>
  <ul id="sortable" class="parent-menu default">
    @foreach($topmenu as $top)
        <li style="margin-bottom:15px" id="topmenu_{{ $top->id }}">
          <div class="topmenu-list" style="width:30%" >
              {{ $top->nama_topmenu }}
          </div>
          <div class="topmenu-list">
              <a href="{{ $top->link_topmenu }}" style="color:#333" target="_blank">{{ $top->link_topmenu }}</a>
          </div>
          <div style="display:inline-block;margin-left:2em" class="pull-right">
            <form action="{{ route('dashboard::deleteTopMenu', $top->id) }}" method="POST">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
              <input id="delete" class="btn btn-danger" type="submit" value="Delete">
            </form>
          </div>
           <a style="margin-left:2em" href="{{ route('dashboard::editTopMenu', $top->id) }}" class="btn btn-warning pull-right">Edit <i class="fa fa-edit fa-fw"></i></a>
        </li>
    @endforeach
  </ul>
</div>
<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%">Urutkan Menu</button>
@endif
@stop

@section('js')
@parent
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"> </script>
<script type="text/javascript">
$(document).ready(function() {
  $('#delete').onclick = function() {
   swal({
     title: 'Are you sure?',
     text: 'You will not be able to recover this imaginary file!',
     type: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!',
     closeOnConfirm: false
   },
   function() {
     swal('Deleted!', 'Your file has been deleted!', 'success');
   });
 });
});
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
