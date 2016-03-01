@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
@stop

@section('content')
@include('includes.alert')
<table class="table table-bordered" id="allposts">
    <thead>
        <tr>
            <th>Judul Indonesia</th>
            <th>Isi Indonesia</th>
            <th>Judul English</th>
            <th>Isi English</th>
            <th>Action</th>
            <th>Action</th>
            <th>Action</th>
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
      ajax: "{!! route('dashboard::getAllPosts') !!}",
      columns: [
          { data: 'title_id', name: 'title_id' },
          { data: 'content_id', name: 'content_id' },
          { data: 'title_en', name: 'title_en' },
          { data: 'content_en', name: 'content_en' },
          { data: 'show', name: 'show', orderable: false, searchable: false},
          { data: 'edit', name: 'edit', orderable: false, searchable: false},
          { data: 'delete', name: 'delete', orderable: false, searchable: false}
      ]
  });
});
</script>
@stop
