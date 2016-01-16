<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\TopMenu;

class TopMenuController extends Controller
{
    public function daftartopmenu()
    {
      $title = 'Daftar Top Menu';
      $topmenu = TopMenu::all()->sortBy('urutan');
      return view('topmenu.index', compact('title', 'topmenu'));
    }
}
