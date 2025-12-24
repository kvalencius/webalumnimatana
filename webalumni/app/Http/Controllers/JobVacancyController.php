<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobVacancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except(['index', 'show']);
    }

    // ================= PUBLIC =================
    public function index(Request $request)
    {
        $query = JobVacancy::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', "%{$request->lokasi}%");
        }

        $jobs = $query->paginate(3);
        $locations = JobVacancy::distinct()->pluck('lokasi');

        return view('job_vacancies.index', compact('jobs', 'locations'));
    }

    public function show($id)
    {
        $job = JobVacancy::findOrFail($id);
        return view('job_vacancies.show', compact('job'));
    }

    // ================= ADMIN =================
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
        'judul'          => 'required|string|max:200',
        'perusahaan'     => 'required|string|max:150',
        'tipe_pekerjaan' => 'required',
        'lokasi'         => 'required|string|max:100',
        'deskripsi'      => 'required|string',
        'persyaratan'    => 'nullable|string',
        'poster'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $validated['posted_by'] = Auth::id();

    if ($request->hasFile('poster')) {
        $validated['poster'] = $request->file('poster')->store('posters', 'public');
    }

    JobVacancy::create($validated);

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
            'judul'          => 'required|string|max:200',
            'perusahaan'     => 'required|string|max:150',
            'tipe_pekerjaan' => 'required|in:full_time,part_time,internship,contract,freelance',
            'lokasi'         => 'required|string|max:100',
            'deskripsi'      => 'required|string',
            'persyaratan'    => 'nullable|string',
            'poster'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gaji_min'       => 'nullable|numeric|min:0',
            'gaji_max'       => 'nullable|numeric|min:0|gte:gaji_min',
            'kontak_email'   => 'nullable|email|max:100',
            'kontak_phone'   => 'nullable|string|max:20',
        ]);

        // 🔥 PENTING: jangan set poster ke NULL
        if ($request->hasFile('poster')) {
            if ($job->poster && Storage::disk('public')->exists($job->poster)) {
                Storage::disk('public')->delete($job->poster);
            }

            $validated['poster'] =
                $request->file('poster')->store('posters', 'public');
        } else {
            unset($validated['poster']); // INI KUNCINYA
        }

        $job->update($validated);

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $job = JobVacancy::findOrFail($id);

        if ($job->poster && Storage::disk('public')->exists($job->poster)) {
            Storage::disk('public')->delete($job->poster);
        }

        $job->delete();

        return redirect()
            ->route('admin.jobs.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}
