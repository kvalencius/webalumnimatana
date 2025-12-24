<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    public function __construct()
    {
        // Semua method butuh auth
        $this->middleware('auth');
        
        // Hanya admin yang bisa akses method selain index dan show
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    /**
     * =========================
     * PUBLIK (Mahasiswa & Alumni)
     * Hanya bisa LIHAT saja
     * =========================
     */
    public function index(Request $request)
    {
        $query = JobVacancy::latest();

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $jobs = $query->paginate(12);
        $locations = JobVacancy::distinct()->pluck('lokasi');

        return view('job_vacancies.index', compact('jobs', 'locations'));
    }

    public function show($id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('job_vacancies.show', compact('job'));
    }

    /**
     * =========================
     * ADMIN - Kelola Lowongan
     * Bisa CRUD (Create, Read, Update, Delete)
     * =========================
     */
    public function adminIndex()
    {
        $jobs = JobVacancy::latest()->paginate(15);
        return view('admin.job_vacancies.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.job_vacancies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perusahaan' => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email' => 'nullable|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        // Admin langsung publish, tidak perlu approval
        JobVacancy::create(array_merge($validated, [
            'posted_by' => Auth::id(),
        ]));

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil dipublish.');
    }

    public function edit($id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('admin.job_vacancies.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = JobVacancy::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perusahaan' => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email' => 'nullable|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        $job->update($validated);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        JobVacancy::findOrFail($id)->delete();
        
        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}