<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the create form for teacher data
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'teacher') {
            abort(403);
        }

        $teacher = Teacher::find($user->id);
        return view('dosen.create', compact('teacher'));
    }

    /**
     * Store teacher data
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'teacher') {
            abort(403);
        }

        $validated = $request->validate([
            'nip' => 'required|string|unique:teachers,nip,' . $user->id . ',user_id',
            'department' => 'required|string',
            'phone' => 'required|string',
            'office' => 'required|string',
            'specialization' => 'required|string',
        ]);

        try {
            Teacher::updateOrCreate(
                ['user_id' => $user->id],
                $validated
            );

            $user->update(['data_completed' => true]);

            return redirect('/profil')->with('success', 'Data dosen berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error storing teacher data', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the edit form for teacher
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->role !== 'teacher' || $user->id != $id) {
            abort(403);
        }

        $teacher = Teacher::find($id);
        if (!$teacher) {
            return redirect()->route('teacher.create')
                ->with('error', 'Data dosen tidak ditemukan');
        }

        return view('dosen.edit', compact('teacher'));
    }

    /**
     * Update teacher data
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'teacher' || $user->id != $id) {
            abort(403);
        }

        $validated = $request->validate([
            'nip' => 'required|string|unique:teachers,nip,' . $id . ',user_id',
            'department' => 'required|string',
            'phone' => 'required|string',
            'office' => 'required|string',
            'specialization' => 'required|string',
        ]);

        try {
            Teacher::where('user_id', $id)->update($validated);
            
            \Log::info('Teacher data updated', ['user_id' => $id]);
            
            return redirect()->route('profil')->with('success', 'Data dosen berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating teacher data', [
                'user_id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Display listing (not used)
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show teacher profile (redirect to profil)
     */
    public function show($id)
    {
        return redirect()->route('profil');
    }

    /**
     * Delete teacher data (not implemented)
     */
    public function destroy($id)
    {
        abort(404);
    }
}
