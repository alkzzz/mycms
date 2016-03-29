<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;

class DosenController extends Controller
{
    public function __construct()
    {
        $this->middleware('menu');
    }

    public function index() {
        return view('dosen.index');
    }

    public function daftarDosen() {
        $title = 'Dosen';
        return view('dosen.daftarDosen', compact('title'));
    }
}
