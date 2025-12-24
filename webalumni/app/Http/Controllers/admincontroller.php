<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\JobVacancy;
use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // Statistik Card
        $totalAlumni = Alumni::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalLoker = JobVacancy::count();

        // Ambil data alumni terbaru BESERTA data usernya (Nama)
        $latestAlumni = Alumni::with('user')->latest('user_id')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalAlumni', 
            'totalMahasiswa', 
            'totalLoker', 
            'latestAlumni'
        ));
    }
}