@foreach($top_menu as $top)
  <li><a href="{{ $top->link_topmenu }}" target="_blank">{{ $top->nama_topmenu }}</a></li>
@endforeach
