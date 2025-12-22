<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layout.beranda');
    }

    public function tentang()
    {
        return view('tentang.index');
    }

    public function berita()
    {
        return view('berita.index');
    }

    public function lowongan()
    {
        return view('lowongan.index');
    }

    public function events()
    {
        return view('events.index');
    }

    public function kontak()
    {
        return view('kontak.index');
    }
}
