<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Post;
use cms\Slider;

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

    public function urutSlider(Request $request)
    {
      $data = $request->all();
      parse_str($data['urutan'], $urutan);
      $daftarslider = Slider::all();
      foreach ($urutan['slider'] as $key => $value) {
          foreach ($daftarslider as $slider) {
              $i = array_search($slider->id, $urutan['slider']);
              $slider->urutan_slider = $i;
              $slider->save();
          }
      }
    }
}
