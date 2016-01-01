<?php

namespace cms\Http\Controllers;

use Illuminate\Http\Request;
use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use Localization;
use cms\Post;
use cms\Category;
use cms\Http\Requests\MenuRequest;
use Flash;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('menu');
    }

    public function urutmenu(Request $request)
    {
    	$data = $request->all();
      parse_str($data['urutan'], $urutan);
      $daftarmenu = Post::page()->menu()->get();
      $daftarsubmenu = Post::page()->submenu()->get();

        foreach ($urutan['menu'] as $slug => $value) {
            foreach ($daftarmenu as $menu) {
                $i = array_search($menu->id, array_keys($urutan['menu']));
                $menu->urutan = $i;
                $menu->save();
            }
        }
        foreach ($urutan['submenu'] as $sub => $menu) {
            foreach ($daftarsubmenu as $submenu) {
                $j = array_search($submenu->id, array_keys($urutan['submenu']));
                $submenu->urutan = $j;
                $submenu->save();
            }
        }
    }

    public function daftarMenu()
    {
      $title = 'Daftar Menu';
    	$daftarmenu = Post::page()->menu()->get()->sortBy('urutan');
      $daftarsubmenu = Post::page()->submenu()->get()->sortBy('urutan');
    	return view('dashboard.daftarmenu', compact('title','daftarmenu','daftarsubmenu'));
    }

    public function showPage($menu)
    {
        $locale = Localization::getCurrentLocale();
        if ($page = Post::page()->where('slug_'.$locale, '=', $menu)->first())
        {
          return view('page.showPage', compact('page'));
        }
        else {
          $page = Category::where('id','!=',1)
                          ->where('slug_'.$locale, '=', $menu)->firstOrFail();
          $daftar_artikel = Post::article()->where('id_kategori', '=', $page->id)->get();
          return view('kategori.index', compact('page', 'daftar_artikel'));
        }
    }

    public function addPage()
    {
        $title = 'Tambah Menu';
        return view('page.addPage', compact('title'));
    }

    public function storePage(MenuRequest $request)
    {
        $input = $request->all();
        $input['urutan'] = 99;
        $input['post_type'] = 'page';
        $input['id_kategori'] = 1;
        $inputjudul_id = $request->input('title_id');
        $inputjudul_en = $request->input('title_en');

        if ($request->input('has_child') == 0) {
          $input['title_id'] = $inputjudul_id;
          $input['title_en'] = $inputjudul_en;
          $input['slug_id'] = str_slug($input['title_id']);
          $input['slug_en'] = str_slug($input['title_en']);
          try {
          Post::create($input);
          } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062) { // duplicate entry
              Flash::error('Judul menu yang anda masukkan sudah digunakan.');
              return redirect()->back();
            }
          }
          Flash::success('Menu telah berhasil ditambahkan.');
          return redirect()->route('dashboard::menu');
        }
        else
        {
            if (count($inputjudul_id) == count($inputjudul_en)) { // kalo jumlahnya sama
              $inputjudul = array_combine($inputjudul_id, $inputjudul_en); // gabung input jadi key dan value
            }
            else
            {
              Flash::error('Jumlah submenu yang dimasukkan untuk bahasa Indonesia dan bahasa Inggris tidak sama.');
              return redirect()->back();
            }
            $i = 0; // index = 0
            foreach ($inputjudul as $judul_id => $judul_en) {
              if ($i == 0) { // masukkan parent menu terlebih dahulu
                $post_parent = $judul_id;
                $input['title_id'] = $judul_id;
                $input['title_en'] = $judul_en;
                $input['slug_id'] = str_slug($input['title_id']);
                $input['slug_en'] = str_slug($input['title_en']);
                try {
                Post::create($input);
                } catch (\Illuminate\Database\QueryException $e) {
                  $errorCode = $e->errorInfo[1];
                  if($errorCode == 1062) { // duplicate entry
                    Flash::error('Judul menu yang anda masukkan sudah digunakan.');
                    return redirect()->back();
                  }
                }
                $parent_id = Post::page()->where('title_id','=',$post_parent)->lists('id')->first(); // ambil id parent
              }
              else { //masukkan child menu
                $input['title_id'] = $judul_id;
                $input['title_en'] = $judul_en;
                $input['slug_id'] = str_slug($input['title_id']);
                $input['slug_en'] = str_slug($input['title_en']);
                $input['has_child'] = 0;
                $input['post_parent'] = $parent_id; // masukkan id parent ke child
                try {
                Post::create($input);
                } catch (\Illuminate\Database\QueryException $e) {
                  $errorCode = $e->errorInfo[1];
                  if($errorCode == 1062) { // duplicate entry
                    Flash::error('Judul menu yang anda masukkan sudah digunakan.');
                    return redirect()->back();
                  }
                }
              }
              $i++; //increment index
            }
            Flash::success('Menu telah berhasil ditambahkan.');
            return redirect()->route('dashboard::menu');
        }
    }

    public function editPage($slug)
    {
      $title = "Edit Menu";
      $page = Post::page()->where('slug_id', '=', $slug)->firstOrFail();
      $submenu = Post::page()->where('post_parent', '=', $page->id)->get();
      return view('page.editPage', compact('title', 'page', 'submenu'));
    }

    public function updatePage(MenuRequest $request, $slug)
    {
      $page = Post::page()->where('slug_id', '=', $slug)->firstOrFail();
      $input = $request->all();
      $input['slug_id'] = str_slug($request->input('title_id'));
      $input['slug_en'] = str_slug($request->input('title_en'));
      try {
      $page->update($input);
      } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062) { // duplicate entry
          Flash::error('Judul menu yang anda masukkan sudah digunakan.');
          return redirect()->back();
        }
      }
      Flash::success('Menu telah berhasil diupdate.');
      return redirect()->route('dashboard::menu');
    }

}
