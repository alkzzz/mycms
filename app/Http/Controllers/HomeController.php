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
        //\Auth::loginUsingId(1); #admin
        \Auth::logout();
        return view('homepage', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function berita()
    {
        return view('dashboard.menu_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function waktu()
    {
        $jadwal_lama_mulai = Carbon::create('2015', '11', '12', '8');
        $jadwal_lama_selesai = Carbon::create('2015', '11', '12', '10', '30');

        $jadwal_baru_mulai = Carbon::create('2015', '11', '12', '9');
        $jadwal_baru_selesai = Carbon::create('2015', '11', '12', '11', '30');

        if ($jadwal_baru_mulai->between($jadwal_lama_mulai, $jadwal_lama_selesai) or $jadwal_baru_selesai->between($jadwal_lama_mulai, $jadwal_lama_selesai))
        {
          $cek = 'Bentrok';
        }
        else {
          $cek = 'Tidak Bentrok';
        }
        dd($cek);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
