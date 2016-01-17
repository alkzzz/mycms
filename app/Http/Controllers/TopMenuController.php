<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\TopMenu;
use Log;

class TopMenuController extends Controller
{
    public function daftartopmenu()
    {
      $title = 'Daftar Top Menu';
      $topmenu = TopMenu::all()->sortBy('urutan');
      return view('topmenu.index', compact('title', 'topmenu'));
    }

    public function urutTopMenu(Request $request)
    {
        $data = $request->all();
        parse_str($data['urutan'], $urutan);
        $daftartopmenu = TopMenu::all();
        Log::info($urutan);
        foreach ($urutan['topmenu'] as $key => $value) {
            foreach ($daftartopmenu as $topmenu) {
                $i = array_search($topmenu->id, $urutan['topmenu']);
                $topmenu->urutan = $i;
                $topmenu->save();
            }
        }

    }
}
