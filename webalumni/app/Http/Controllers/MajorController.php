<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    // Menampilkan daftar jurusan
    public function index()
    {
        $majors = Major::all();
        return view('admin.majors.index', compact('majors'));
    }

    // Menyimpan jurusan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:majors,name'
        ]);

        Major::create($request->all());
        return back()->with('success', 'Jurusan berhasil ditambahkan!');
    }

    // Menghapus jurusan
    public function destroy($id)
    {
        Major::findOrFail($id)->delete();
        return back()->with('success', 'Jurusan berhasil dihapus!');
    }
}