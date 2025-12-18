<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the create form for alumni data
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'alumni') {
            abort(403);
        }

        $alumni = Alumni::find($user->id);
        return view('alumni.create', compact('alumni'));
    }

    /**
     * Store alumni data
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'alumni') {
            abort(403);
        }

        $validated = $request->validate([
            'nim' => 'required|string',
            'graduation_year' => 'required|integer|min:2000|max:' . date('Y'),
            'major' => 'required|string',
            'current_job' => 'required|in:bekerja,tidak_bekerja,melanjutkan_studi',
            'company_name' => 'nullable|string',
            'job_position' => 'nullable|string',
            'salary_range' => 'string|nullable',
            'phone' => 'required|string',
        ]);

        try {
            $validated['user_id'] = $user->id;
            
            // Auto-fill company_name and job_position based on employment status
            if ($validated['current_job'] !== 'bekerja') {
                $validated['company_name'] = '-';
                $validated['job_position'] = '-';
                $validated['salary_range'] = null;
            }
            
            $exists = DB::table('alumni')->where('user_id', $user->id)->exists();
            
            if ($exists) {
                DB::table('alumni')->where('user_id', $user->id)->update($validated);
                \Log::info('Alumni data updated via DB', ['user_id' => $user->id]);
            } else {
                DB::table('alumni')->insert($validated);
                \Log::info('Alumni data created via DB', ['user_id' => $user->id, 'data' => $validated]);
            }

            $user->update(['data_completed' => true]);

            return redirect('/profil')->with('success', 'Data alumni berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error storing alumni data', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the edit form for alumni
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->role !== 'alumni' || $user->id != $id) {
            abort(403);
        }

        $alumni = Alumni::find($id);
        if (!$alumni) {
            return redirect()->route('alumni.create')
                ->with('error', 'Data alumni tidak ditemukan');
        }

        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update alumni data
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'alumni' || $user->id != $id) {
            abort(403);
        }

        $validated = $request->validate([
            'nim' => 'required|string',
            'graduation_year' => 'required|integer|min:2000|max:' . date('Y'),
            'major' => 'required|string',
            'current_job' => 'required|in:bekerja,tidak_bekerja,melanjutkan_studi',
            'company_name' => 'nullable|string',
            'job_position' => 'nullable|string',
            'salary_range' => 'string|nullable',
            'phone' => 'required|string',
        ]);

        try {
            $validated['user_id'] = $user->id;
            
            // Auto-fill company_name and job_position based on employment status
            if ($validated['current_job'] !== 'bekerja') {
                $validated['company_name'] = '-';
                $validated['job_position'] = '-';
                $validated['salary_range'] = null;
            }
            
            DB::table('alumni')->where('user_id', $id)->update($validated);
            
            \Log::info('Alumni data updated', ['user_id' => $id]);
            
            return redirect()->route('profil')->with('success', 'Data alumni berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating alumni data', [
                'user_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Show alumni profile (kept for backward compatibility)
     */
    public function show($id)
    {
        return redirect()->route('profil');
    }

    /**
     * Display listing (not used in current flow)
     */
    public function index()
    {
        // Not implemented - alumni access their own profile via profil route
        abort(404);
    }

    /**
     * Delete alumni data (not implemented)
     */
    public function destroy($id)
    {
        abort(404);
    }
}
