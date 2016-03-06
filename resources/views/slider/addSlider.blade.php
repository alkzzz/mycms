@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<style media="screen">
.table tbody tr td {
  vertical-align: middle;
}
#uploadGambar {
  display: none;
}
</style>
@stop

@section('content')
@include('includes.alert')
<table class="table table-striped table-hover table-responsive text-center" id="allposts">
    <thead>
        <tr>
            <th class="text-center">Gambar</th>
            <th class="text-center">Judul Indonesia</th>
            <th class="text-center">Judul English</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
</table>
@stop

@section('js')
@parent
<!-- Datatables JS -->
<script type="text/javascript" src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script>
$(function() {
  $('#allposts').DataTable({
      processing: false,
      serverSide: true,
      autoWidth: false,
      order : [[ 1, "asc" ]],
      ajax: "{!! route('dashboard::dataTableSlider') !!}",
      columns: [
          { data: 'slider.thumbnail',
            render: function(data, type, row) {
            return '<img src="'+data+'" />';}, name:'slider.thumbnail' },
          { data: 'title_id', name: 'title_id' },
          { data: 'title_en', name: 'title_en' },
          { data: 'edit', name: 'edit', orderable: false, searchable: false},
      ]
  });
});
</script>
@stop
