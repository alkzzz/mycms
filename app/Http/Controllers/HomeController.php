<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use Carbon\Carbon;
use cms\Post;
use cms\Category;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('menu');
    }

    public function index()
    {
        $title = 'Home';
        $sliders = Post::featured()->with('slider', 'category')
                  ->join('sliders', 'posts.id_gambar', '=', 'sliders.id')
                  ->orderBy('sliders.urutan_slider', 'asc')
                  ->get();         

        $kategori = Category::with('articles')->where('id', '>', 1)->take(3)->get();
        return view('homepage', compact('title', 'sliders','kategori'));
    }

    public function chart()
    {
      return view('chart');
    }

    public function search(Request $request)
    {
      $query = $request->get('q');
      $title = 'Search Results';
      if (\Localization::getCurrentLocale()=='id')
      {
      $results = Post::search($query, ['title_id' => 10, 'content_id' => 5])->get();
      }
      else {
      $results = Post::search($query, ['title_en' => 10, 'content_en' => 5])->get();
      }
      return view('search', compact('title', 'query', 'results'));
    }

    public function getChartData()
    {
      $tahun = ['2010','2011','2012','2013','2014'];
      $nilai = [15,20,25,30,35];
      for ($i=0; $i < count($tahun) ; $i++) {
        $data[$i] = array('tahun'=>$tahun[$i], 'nilai'=>$nilai[$i]);
      }
      return $data;
    }

}
