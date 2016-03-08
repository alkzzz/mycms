<?php

namespace cms\Http\Controllers;

use Localization;
use Illuminate\Http\Request;

use cms\Http\Requests;
use cms\Http\Controllers\Controller;
use cms\Category;
use cms\Post;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('menu');
    }

    public function showPost($kategori, $post)
    {
        $locale = Localization::getCurrentLocale();
        $article = Post::article()->where('slug_'.$locale, '=', $post)->firstOrFail();
        $kat = Category::where('id','!=',1) // bukan kategori 1 yaitu menu
                          ->where('slug_'.$locale, '=', $kategori)
                          ->where('id', '=', $article->id_kategori)
                          ->firstOrFail();
        return view('article.showPost', compact('kat', 'article'));
    }

    public function editPost($id)
    {
      $title = "Edit Artikel";
      $post = Post::article()->where('id', '=', $id)->firstOrFail();
      return view('post.editPost', compact('title', 'post'));
    }
}
