<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\JobVacancy;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        // Mengambil statistik sesuai rencana Anda
        $totalAlumni = Alumni::count();
        $pendingVerif = Alumni::where('status', 'pending')->count();
        $totalLoker = JobVacancy::count();

        return view('admin.dashboard', compact('totalAlumni', 'pendingVerif', 'totalLoker'));
    }
}