<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Post;

class SliderController extends Controller
{
    public function daftarslider()
    {
      $title = 'Daftar Slider';
      $sliders = Post::featured()->with('slider')
                ->join('sliders', 'posts.id_gambar', '=', 'sliders.id')
                ->orderBy('sliders.urutan_slider', 'asc')
                ->get();
      return view('slider.index', compact('title', 'sliders'));
    }
}
