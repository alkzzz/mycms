<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\TopMenu;
use Flash;

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
        foreach ($urutan['topmenu'] as $key => $value) {
            foreach ($daftartopmenu as $topmenu) {
                $i = array_search($topmenu->id, $urutan['topmenu']);
                $topmenu->urutan = $i;
                $topmenu->save();
            }
        }
    }

    public function addTopMenu()
    {
      $title = 'Tambah Top Menu';
      return view('topmenu.tambah', compact('title'));
    }

    public function storeTopMenu(Request $request)
    {
      #validasi
      $this->validate($request, [
        'nama_topmenu' => 'required',
        'link_topmenu' => 'required | active_url',
        ]);

        $input = $request->all();
        try {
        TopMenu::create($input);
        } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          if($errorCode == 1062) { // duplicate entry
            Flash::error('Judul top menu yang anda masukkan sudah digunakan.');
            return redirect()->back();
          }
        }
        Flash::success('Top menu telah berhasil ditambahkan.');
        return redirect()->route('dashboard::topmenu');
    }

    public function editTopMenu($id)
    {
      $title = 'Edit Top Menu';
      $top = TopMenu::find($id);
      return view('topmenu.edit', compact('title','top'));
    }

    public function updateTopMenu(Request $request, $id)
    {
      #validasi
      $this->validate($request, [
        'nama_topmenu' => 'required',
        'link_topmenu' => 'required | active_url',
        ]);

      $top = TopMenu::find($id);
      $input = $request->all();
      try {
      $top->update($input);
      } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062) { // duplicate entry
          Flash::error('Judul top menu yang anda masukkan sudah digunakan.');
          return redirect()->back();
        }
      }
      Flash::success('Top menu telah berhasil diupdate.');
      return redirect()->route('dashboard::topmenu');
    }

    public function deleteTopMenu($id)
    {
      $top = TopMenu::find($id);
      $top->delete();
      Flash::success('Top menu telah berhasil didelete.');
      return redirect()->route('dashboard::topmenu');
    }
}
