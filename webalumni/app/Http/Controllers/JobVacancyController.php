<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    /**
     * Tampilkan semua lowongan aktif (Mahasiswa & Alumni)
     */
    public function index(Request $request)
    {
        $query = JobVacancy::where('status', 'approved')
            ->with('postedBy')
            ->latest();

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        // Filter Lokasi
        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $jobs = $query->paginate(12);
        
        // Ambil daftar lokasi unik untuk dropdown filter
        $locations = JobVacancy::distinct()->pluck('lokasi');

        return view('job_vacancies.index', compact('jobs', 'locations'));
    }

    /**
     * Detail Lowongan
     */
    public function show($id)
    {
        $job = JobVacancy::with('postedBy')->findOrFail($id);
        return view('job_vacancies.show', compact('job'));
    }

    /**
     * Alumni - Form buat lowongan
     */
    public function create()
    {
        return view('job_vacancies.create');
    }

    /**
     * Alumni - Simpan dan langsung PUBLISH
     */
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
            'kontak_email' => 'required|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        JobVacancy::create([
            'judul' => $validated['judul'],
            'perusahaan' => $validated['perusahaan'],
            'tipe_pekerjaan' => $validated['tipe_pekerjaan'],
            'lokasi' => $validated['lokasi'],
            'deskripsi' => $validated['deskripsi'],
            'persyaratan' => $validated['persyaratan'] ?? null,
            'gaji_min' => $validated['gaji_min'] ?? null,
            'gaji_max' => $validated['gaji_max'] ?? null,
            'kontak_email' => $validated['kontak_email'],
            'kontak_phone' => $validated['kontak_phone'] ?? null,
            'posted_by' => Auth::id(),
            'status' => 'approved' // Langsung aktif tanpa approval
        ]);

        return redirect()->route('jobs.my-jobs')
            ->with('success', 'Lowongan berhasil diposting dan sudah aktif!');
    }

    /**
     * Alumni - Form edit lowongan milik sendiri
     */
    public function edit($id)
    {
        // Pastikan hanya pemilik yang bisa edit
        $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);
        
       return view('job_vacancies.edit', compact('job'));
    }

    /**
     * Alumni - Update lowongan
     */
    public function update(Request $request, $id)
    {
        $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'perusahaan' => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'persyaratan' => 'nullable|string',
            'gaji_min' => 'nullable|numeric|min:0',
            'gaji_max' => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email' => 'required|email|max:100',
            'kontak_phone' => 'nullable|string|max:20',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.my-jobs')->with('success', 'Lowongan berhasil diperbarui!');
    }

    /**
     * Alumni - Hapus lowongan milik sendiri
     */
    public function destroy($id)
    {
        $job = JobVacancy::where('posted_by', Auth::id())->findOrFail($id);
        $job->delete();

        return back()->with('success', 'Lowongan berhasil dihapus!');
    }

    /**
     * Alumni - Manajemen lowongan pribadi
     */
    public function myJobs()
    {
        $jobs = JobVacancy::where('posted_by', Auth::id())
            ->latest()
            ->get();

        return view('job_vacancies.my-jobs', compact('jobs'));
    }
}