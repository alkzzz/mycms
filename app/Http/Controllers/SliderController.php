<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Post;
use cms\Slider;
use Flash;

class SliderController extends Controller
{
    public function daftarslider()
    {
      $title = 'Daftar Slider';
      $sliders = Post::featured()->join('sliders', 'posts.id_gambar', '=', 'sliders.id')
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

    public function showRemoveSlider($id)
    {
      $title = "Delete Slider";
      $post = Post::featured()->with('slider')->where('id_gambar', '=', $id)->firstOrFail();
      return view('slider.showRemoveSlider', compact('title', 'post'));
    }

    public function removeSlider($id)
    {
      $post = Post::featured()->with('slider')->where('id_gambar', '=', $id)->firstOrFail();
      $post->featured = false;
      $post->save();
      Flash::success('Artikel telah berhasil dihapus dari slideshow halaman utama.');
      return redirect()->route('dashboard::slider');
    }
}
