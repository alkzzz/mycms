@extends('_layouts.dashboard')

@section('title', $title)

@section('css')
@parent
<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.css') }}">
@stop

@section('content')
@include('includes.alert')
	<a href="{{ route('dashboard::addPage') }}"><button type="button" class="btn btn-success">Tambah <i class="fa fa-plus-square fa-fw"></i></button></a>
	<hr>
	<h3 class="lang-help"><em>Indonesia</em> / <em>English</em></h3>
	<ul>
	<li style="margin-bottom:15px;margin-top:15px" class="parent-menu default">Beranda / Home</li>
	</ul>
	<ul id="sortable">
	@foreach ($daftarmenu as $menu)
		<li style="margin-bottom:15px;margin-top:15px" id="menu_{{ $menu->id }}" class="parent-menu default">
		<div>{{ $menu->title_id }} / {{ $menu->title_en }} @if ($menu->has_child)
			<a class="arrow-toggle" href="#menu_{{ $menu->slug_id }}" data-toggle="collapse" aria-expanded="false" aria-controls="{{ $menu->slug_id }}"><span class="fa fa-caret-down fa-fw"></span></a> @endif
		<span class="pull-right">@if (!$menu->has_child)<a style="margin-right:20px" class="btn btn-info" href="{{ route('show.page', $menu->slug_id) }}" target="_blank">Show <i class="fa fa-eye fa-fw"></i></a>
		@endif<a style="margin-right:20px" class="btn btn-warning" href="{{ route('dashboard::editPage', $menu->id) }}">Edit <i class="fa fa-edit fa-fw"></i></a><a class="btn btn-danger" href="{{ route('dashboard::showDeletePage', $menu->id) }}">Delete <i class="fa fa-trash fa-fw"></i></a></span></div>
 	@if(!$menu->has_child) </li>
	@else
			<ul id= "menu_{{ $menu->slug_id }}" class="collapse child-menu default">
			@foreach($daftarsubmenu as $submenu)
			@if($submenu->post_parent == $menu->id)
				<li style="margin-bottom:15px;margin-top:15px" id="submenu_{{ $submenu->id }}">
				<div>{{ $submenu->title_id }} / {{ $submenu->title_en }}
				<span class="pull-right"><a style="margin-right:25px" class="btn btn-info" href="{{ route('show.page', $submenu->slug_id) }}" target="_blank">Show <i class="fa fa-eye fa-fw"></i></a><a style="margin-right:20px" class="btn btn-warning" href="{{ route('dashboard::editPage', $submenu->id) }}">Edit <i class="fa fa-edit fa-fw"></i></a><a style="margin-right:-5px" class="btn btn-danger" href="{{ route('dashboard::showDeletePage', $submenu->id) }}">Delete <i class="fa fa-trash fa-fw"></i></a>
				</div></li>
		</li>
			@endif
			@endforeach
		</ul>
	@endif
	@endforeach
	</ul>
	<button id="urut" type="button" class="btn btn-primary" style="margin-top:2%">Urutkan Menu</button>

	@section('js')
	@parent
	<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('js/nestedSortable.js') }}"></script>
	<script>
	$( ".fa-caret-down" ).click(function() {
	  $( this ).toggleClass( "fa-caret-up" );
	});
	</script>

	<script type="text/javascript">
	$(document).ready(function() {
		$('#urut').click(function() {
			if ($('#urut').text() == "Save") {

				var urutan = $('#sortable').nestedSortable("serialize");

				$('#sortable').nestedSortable({
					disabled : true
				});

				$.ajax({
					url: "{{ route('dashboard::urutMenu')}}",
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

        		$('#sortable').nestedSortable({
        			disabled : false,
        			disableParentChange : true,
        			maxLevels: 2,
        			cursor : "move",
		        	listType: "ul",
		        	handle: 'div',
	            items: 'li',
	            toleranceElement: '> div',
	            placeholder: "highlight",
							opacity: 0.8,
		        });
		        $('#sortable').disableSelection();

				($('#urut').text("Save"));
			}
		});
	});
	</script>
	@stop
@stop
