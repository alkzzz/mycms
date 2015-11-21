@extends('_layouts.dashboard')

@section('title', $title)

@section('content')
	    <table class="table table-bordered" id="users-table">
	        <thead>
	            <tr>
	                <th>Id</th>
	                <th>Name</th>
	                <th>Email</th>
	                <th>Created At</th>
	                <th>Updated At</th>
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
              $('#users-table').DataTable({
                  processing: false,
                  serverSide: true,
                  autoWidth: false,
									order : [[ 1, "asc" ]],
                  ajax: "{!! route('datatables.user') !!}",
                  columns: [
                      { data: 'id', name: 'id' },
                      { data: 'username', name: 'username' },
                      { data: 'email', name: 'email' },
                      { data: 'created_at', name: 'created_at' },
                      { data: 'updated_at', name: 'updated_at' },
                      { data: 'show', name: 'show', orderable: false, searchable: false},
                      { data: 'edit', name: 'edit', orderable: false, searchable: false},
                      { data: 'delete', name: 'delete', orderable: false, searchable: false}
                  ]
              });
          });
          </script>
      @show
