@extends('_layouts.dashboard')

<?php $title = 'Upload Media' ?>

@section('title', $title)

@section('css')
@parent
@stop

@section('js')
	<!-- jQuery and jQuery UI (REQUIRED) -->
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

	<!-- elFinder CSS (REQUIRED) -->
	<link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

	<!-- elFinder JS (REQUIRED) -->
	<script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

	<?php if($locale){ ?>
	<!-- elFinder translation (OPTIONAL) -->
	<script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
	<?php } ?>

	<!-- elFinder initialization (REQUIRED) -->
	<script type="text/javascript" charset="utf-8">
			// Documentation for client options:
			// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
			$().ready(function() {
					$('#elfinder').elfinder({
							// set your elFinder options here
							<?php if($locale){ ?>
									lang: '<?= $locale ?>', // locale
							<?php } ?>
							customData: {
									_token: '<?= csrf_token() ?>'
							},
							url : '<?= route("elfinder.connector") ?>'  // connector URL
					});
			});
	</script>
@stop

@section('content')
<div class="container" style="font-size:1.5em" id="elfinder"></div>
@stop
