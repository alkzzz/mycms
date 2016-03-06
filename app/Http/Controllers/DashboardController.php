<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Post;
use Datatables;

class DashboardController extends Controller
{
  	public function index()
  	{
      $title = 'Home';
  		return view('dashboard.index', compact('title'));
  	}

  	public function daftarUser()
  	{
      $title = 'Daftar User';
  		return view('datatable', compact('title'));
  	}
}
