<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the create form for student data
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            abort(403);
        }

        $student = Student::find($user->id);
        return view('student.create', compact('student'));
    }

    /**
     * Store student data
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'student') {
            abort(403);
        }

        $validated = $request->validate([
            'nim' => 'required|string|unique:students,nim,' . $user->id . ',user_id',
            'major' => 'required|string',
            'semester' => 'required|integer|min:1|max:8',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        try {
            Student::updateOrCreate(
                ['user_id' => $user->id],
                $validated
            );

            $user->update(['data_completed' => true]);

            return redirect('/profil')->with('success', 'Data mahasiswa berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error storing student data', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Show the edit form for student
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->role !== 'student' || $user->id != $id) {
            abort(403);
        }

        $student = Student::find($id);
        if (!$student) {
            return redirect()->route('student.create')
                ->with('error', 'Data mahasiswa tidak ditemukan');
        }

        return view('student.edit', compact('student'));
    }

    /**
     * Update student data
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'student' || $user->id != $id) {
            abort(403);
        }

        $validated = $request->validate([
            'nim' => 'required|string|unique:students,nim,' . $id . ',user_id',
            'major' => 'required|string',
            'semester' => 'required|integer|min:1|max:8',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        try {
            Student::where('user_id', $id)->update($validated);
            
            \Log::info('Student data updated', ['user_id' => $id]);
            
            return redirect()->route('profil')->with('success', 'Data mahasiswa berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating student data', [
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
     * Show student profile (redirect to profil)
     */
    public function show($id)
    {
        return redirect()->route('profil');
    }

    /**
     * Delete student data (not implemented)
     */
    public function destroy($id)
    {
        abort(404);
    }
}
