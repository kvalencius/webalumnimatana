<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\User;
use App\Models\Alumni;
use App\Models\Student;
use App\Models\Teacher;
use Hash;

class AuthController extends Controller
{
    public function loginForm(){
        return view('user.formLogin');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            
            // Redirect based on role and data completion
            if (!$user->data_completed) {
                return redirect()->route('data.form', ['role' => $user->role]);
            }
            return redirect()->intended('/profil');
        }
        return back()->withErrors([
            'email'=>'Email dan Password tidak cocok'
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function registrationForm(){
        return view('user.registrasi');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:alumni,student,teacher',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'email_verified_at' => now(),
            'password' => bcrypt($validated['password']),
            'data_completed' => false,
        ]);

        Auth::login($user);
        return redirect()->route('data.form', ['role' => $user->role]);
    }

    // Tampilkan form pengumpulan data sesuai role
    public function dataForm($role)
    {
        $user = Auth::user();
        if ($user->role !== $role) {
            abort(403);
        }

        return view("user.data.{$role}", compact('user'));
    }

    // Simpan data berdasarkan role
    public function storeData(Request $request, $role)
    {
        $user = Auth::user();
        if ($user->role !== $role) {
            abort(403);
        }

        try {
            if ($role === 'alumni') {
                $validated = $request->validate([
                    'nim' => 'required|string',
                    'graduation_year' => 'required|integer|min:2000|max:' . date('Y'),
                    'major' => 'required|string',
                    'current_job' => 'required|in:bekerja,tidak_bekerja,melanjutkan_studi',
                    'company_name' => 'required_if:current_job,bekerja|string',
                    'job_position' => 'required_if:current_job,bekerja|string',
                    'salary_range' => 'string|nullable',
                    'phone' => 'required|string',
                ]);

                // Use DB::table for more reliable insert/update
                $validated['user_id'] = $user->id;
                
                $exists = DB::table('alumni')->where('user_id', $user->id)->exists();
                
                if ($exists) {
                    DB::table('alumni')->where('user_id', $user->id)->update($validated);
                    \Log::info('Alumni data updated via DB', ['user_id' => $user->id]);
                } else {
                    DB::table('alumni')->insert($validated);
                    \Log::info('Alumni data created via DB', ['user_id' => $user->id, 'data' => $validated]);
                }
            } elseif ($role === 'student') {
                $validated = $request->validate([
                    'nim' => 'required|string|unique:students,nim,' . $user->id . ',user_id',
                    'major' => 'required|string',
                    'semester' => 'required|integer|min:1|max:8',
                    'phone' => 'required|string',
                    'address' => 'required|string',
                ]);

                Student::updateOrCreate(
                    ['user_id' => $user->id],
                    $validated
                );
            } elseif ($role === 'teacher') {
                $validated = $request->validate([
                    'nip' => 'required|string|unique:teachers,nip,' . $user->id . ',user_id',
                    'department' => 'required|string',
                    'phone' => 'required|string',
                    'office' => 'required|string',
                    'specialization' => 'required|string',
                ]);

                Teacher::updateOrCreate(
                    ['user_id' => $user->id],
                    $validated
                );
            }

            $user->update(['data_completed' => true]);

            return redirect('/profil')->with('success', 'Data Anda berhasil disimpan');
        } catch (\Exception $e) {
            \Log::error('Error storing data for role ' . $role, [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withInput()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function profil()
    {
        $user = Auth::user();
        $data = null;

        if ($user->role === 'alumni') {
            $data = Alumni::with('tracerStudy')->find($user->id);
        } elseif ($user->role === 'student') {
            $data = Student::find($user->id);
        } elseif ($user->role === 'teacher') {
            $data = Teacher::find($user->id);
        }

        return view('user.profil', compact('user', 'data'));
    }


    public function updateAlumniData(Request $request)
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
            'company_name' => 'required_if:current_job,bekerja|string',
            'job_position' => 'required_if:current_job,bekerja|string',
            'salary_range' => 'string|nullable',
            'phone' => 'required|string',
        ]);

        try {
            $validated['user_id'] = $user->id;
            
            DB::table('alumni')->where('user_id', $user->id)->update($validated);
            
            \Log::info('Alumni data updated from profil', ['user_id' => $user->id]);
            
            return redirect()->route('profil')->with('success', 'Data alumni berhasil diperbarui!');
        } catch (\Exception $e) {
            \Log::error('Error updating alumni data from profil', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user();

        if (!$user->data_completed) {
            return back()->with('error', 'Lengkapi data profil Anda terlebih dahulu');
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old picture if exists
        if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture)) {
            Storage::delete('public/' . $user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->update(['profile_picture' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }
}
