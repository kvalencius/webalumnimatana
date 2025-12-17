<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TracerStudy;
use App\Models\Alumni;

class TracerStudyController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        
        if ($user->role !== 'alumni') {
            abort(403, 'Hanya alumni yang dapat mengisi tracer study');
        }

        // Check if alumni record exists - use find() since user_id is primary key
        $alumni = Alumni::find($user->id);
        if (!$alumni) {
            return redirect()->route('data.form', 'alumni')
                ->with('error', 'Lengkapi data alumni terlebih dahulu');
        }

        // Check if tracer study already exists
        $existingTracer = TracerStudy::where('alumni_id', $user->id)->first();

        return view('tracer.form', compact('alumni', 'existingTracer'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'alumni') {
            abort(403);
        }

        // Check if alumni record exists - use find() since user_id is primary key
        $alumni = Alumni::find($user->id);
        if (!$alumni) {
            return redirect()->route('data.form', 'alumni')
                ->with('error', 'Data alumni tidak ditemukan. Lengkapi data alumni terlebih dahulu.');
        }
        
        $validated = $request->validate([
            'status' => 'required|in:bekerja_full_time,bekerja_part_time,wiraswasta,lanjut_pendidikan,tidak_kerja_sedang_cari,belum_memungkinkan_kerja',
            'current_company' => 'nullable|string|max:255',
            'current_position' => 'nullable|string|max:255',
            'funding_source' => 'required|in:biaya_sendiri,beasiswa_adik,beasiswa_bidikmisi,beasiswa_ppa,beasiswa_afirmasi,beasiswa_swasta,lainnya',
            'f21_perkuliahan' => 'required|integer|min:1|max:5',
            'f22_demonstrasi' => 'required|integer|min:1|max:5',
            'f23_riset_project' => 'required|integer|min:1|max:5',
            'f24_magang' => 'required|integer|min:1|max:5',
            'f25_praktikum' => 'required|integer|min:1|max:5',
            'f26_kerja_lapangan' => 'required|integer|min:1|max:5',
            'f27_diskusi' => 'required|integer|min:1|max:5',
        ]);

        try {
            $validated['alumni_id'] = $user->id;
            $validated['survey_date'] = now()->toDateString();

            // Check if tracer study already exists
            $existingTracer = TracerStudy::where('alumni_id', $user->id)->first();
            
            if ($existingTracer) {
                // Update existing
                $existingTracer->update($validated);
            } else {
                // Create new
                TracerStudy::create($validated);
            }

            return redirect()->route('profil')->with('success', 'Data tracer study berhasil disimpan!');
        } catch (\Exception $e) {
            \Log::error('Tracer Study Save Error: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'alumni_id' => $user->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Gagal menyimpan tracer study: ' . $e->getMessage());
        }
    }
}
