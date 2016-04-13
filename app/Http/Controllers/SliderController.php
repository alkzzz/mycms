<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Post;
use cms\Slider;
use Flash;
use Datatables;

class SliderController extends Controller
{
    public function daftarslider()
    {
      $title = 'Daftar Slider';
      $posts = Post::featured()->with('slider')->get();

      return view('slider.listSlider', compact('title', 'posts'));
    }

    public function urutSlider(Request $request)
    {
      $data = $request->all();
      parse_str($data['urutan'], $urutan);
      $daftarslider = Slider::all();
      foreach ($urutan['post'] as $key => $value) {
          foreach ($daftarslider as $slider) {
              $i = array_search($slider->id, $urutan['post']);
              $slider->urutan_slider = $i;
              $slider->save();
          }
      }
    }

    public function dataTableSlider()
    {
      $posts = Post::with('slider')
                    ->where('featured', '=', false)
                    ->where('has_child', '=', 0)
                    ->latest()->get();

      return Datatables::of($posts)
              ->addColumn('edit', function ($post) {
                  if ($post->post_type == 'page') {
                    return '<a href="'.route('dashboard::editPage', $post->id).'" class="btn btn-info"><i class="fa fa-camera fa-fw"></i> Upload gambar</a>';
                  }
                  else {
                    return '<a href="'.route('dashboard::editPost', $post->id).'" class="btn btn-info"><i class="fa fa-camera fa-fw"></i> Upload gambar</a>';
                  }
            })->make(true);
    }

    public function addSlider()
    {
      $title = "Tambah Slider";
      return view('slider.addSlider', compact('title'));
    }

    public function addToSlider($id)
    {
      $post = Post::find($id);
      $post->featured = true;
      $post->save();
      Flash::success('Artikel telah berhasil ditambahkan ke slideshow halaman utama.');
      return redirect()->route('dashboard::slider');
    }

    public function showRemoveSlider($id)
    {
      $title = "Delete Slider";
      $post = Post::find($id);
      return view('slider.showRemoveSlider', compact('title', 'post'));
    }

    public function removeSlider($id)
    {
      $post = Post::find($id);
      $post->featured = false;
      $post->save();
      Flash::success('Artikel telah berhasil dihapus dari slideshow halaman utama.');
      return redirect()->route('dashboard::slider');
    }
}
