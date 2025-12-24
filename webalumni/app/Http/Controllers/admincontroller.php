<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\JobVacancy;
use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // 1. Mengambil angka statistik
        $totalAlumni = Alumni::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count(); 
        $totalLoker = JobVacancy::count();

        // 2. MENGAMBIL DATA BESERTA NAMA USER (Gunakan with)
        // Ini kunci agar nama 'Naomixds' muncul
        $latestAlumni = Alumni::with('user')->latest('user_id')->take(5)->get();

        // 3. Kirim variabel (Pastikan compact berisi variabel yang tepat)
        return view('admin.dashboard', compact(
            'totalAlumni', 
            'totalMahasiswa', 
            'totalLoker', 
            'latestAlumni'
        ));
    }
}