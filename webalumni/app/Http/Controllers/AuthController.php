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
                if ($user->role === 'alumni') {
                    return redirect()->route('alumni.create');
                } elseif ($user->role === 'student') {
                    return redirect()->route('student.create');
                } elseif ($user->role === 'teacher') {
                    return redirect()->route('teacher.create');
                }
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
