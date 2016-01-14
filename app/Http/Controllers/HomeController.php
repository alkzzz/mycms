<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use Carbon\Carbon;

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

    public function getChartData()
    {
      $data=[
        ['tahun'=>'2011', 'nilai'=>20],
        ['tahun'=>'2012', 'nilai'=>30],
        ['tahun'=>'2013', 'nilai'=>40],
        ['tahun'=>'2014', 'nilai'=>50],
      ];
      return $data;
    }

}
