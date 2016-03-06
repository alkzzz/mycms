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
      $sliders = Post::featured()->join('sliders', 'posts.id_gambar', '=', 'sliders.id')
                ->orderBy('sliders.urutan_slider', 'asc')
                ->get();
      return view('slider.listSlider', compact('title', 'sliders'));
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

    public function dataTableSlider()
    {
      $posts = Post::article()->orWhere('post_parent','<>',0)->latest()->with('slider')->get();

      return Datatables::of($posts)
              ->addColumn('edit', function ($post) {
                if ($post->slider->gambar == '') {
                  if ($post->post_type == 'page') {
                    return '<a href="'.route('dashboard::editPage', $post->id).'" class="btn btn-info"><i class="fa fa-camera fa-fw"></i> Tambahkan gambar</a>';
                  }
                  else {
                    return '<a href="'.route('dashboard::editPost', $post->id).'" class="btn btn-info"><i class="fa fa-camera fa-fw"></i> Tambahkan gambar</a>';
                  }
                }
                else {
                  return '<form action="'.route('dashboard::addToSlider', $post->id).'" method="post">
                          <input type="hidden" name="_token" value="'.csrf_token().'">
                          <input type="hidden" name="_method" value="PATCH">
                          <button type="submit" class="btn btn-success">
                          <i class="fa fa-plus-square fa-fw"></i> Tambahkan ke slider
                          </button>
                          </form>';
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
