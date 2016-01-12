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

}
