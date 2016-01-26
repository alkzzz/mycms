<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use Carbon\Carbon;
use cms\Post;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('menu');
    }

    public function index()
    {
        $title = 'Home';
        return view('homepage', compact('title'));
    }

    public function chart()
    {
      return view('chart');
    }

    public function search(Request $request)
    {
      $query = $request->get('q');
      $title = 'Search Results';
      $results = Post::search($query)->get();
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
