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
        $kat = Category::where('slug_'.$locale, '=', $kategori)
                          ->where('id', '=', $article->id_kategori)
                          ->firstOrFail();
        return view('article.showPost', compact('kat', 'article'));
    }
}
