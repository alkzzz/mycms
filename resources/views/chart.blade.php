@extends('_layouts.base')

@section('css')
@parent
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')
<div id="chartsaya" style="height: 350px;"></div>

@endsection

@section('js')
@parent
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script type="text/javascript">
$(function() {

  // Create a Bar Chart with Morris
  var chart = Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'chartsaya', // Set initial data (ideally you would provide an array of default data)
    xkey: 'tahun', // Set the key for X-axis
    ykeys: ['nilai'], // Set the key for Y-axis
    labels: ['Nilai Per Tahun'] // Set the label when bar is rolled over
  });
  // Fire off an AJAX request to load the data
  $.ajax({
      type: "GET",
      url: "{{ route('getChartData') }}", // This is the URL to the API
    })
    .done(function( data ) {
      // When the response to the AJAX request comes back render the chart with new data
      chart.setData(data);
    })
    .fail(function() {
      // If there is no communication between the server, show an error
      alert( "Ada error chartnya ga bisa cuy" );
    });
});
</script>
@endsection
