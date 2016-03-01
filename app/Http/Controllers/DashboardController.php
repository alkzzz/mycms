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

  	public function getAllPosts()
  	{
      $post = Post::latest()->get();

  		return Datatables::of($post)
            ->addColumn('show', function ($post) {
                return '<a href="test/'.$post->id.'" class="btn btn-success"><i class="fa fa-eye fa-fw"></i> Show</a>';
              })
              ->addColumn('edit', function () {
                return '<a href="" class="btn btn-info"><i class="fa fa-edit fa-fw"></i> Edit</a>';
            })
            ->addColumn('delete', function () {
              return '<a href="" class="btn btn-danger"><i class="fa fa-trash fa-fw"></i> Delete</a>';
            })->make(true);
  	}

  	public function daftarUser()
  	{
      $title = 'Daftar User';
  		return view('datatable', compact('title'));
  	}
}
