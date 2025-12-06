<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // form login
    public function loginForm(){
        return view('user.formLogin');
    }
    // cek user login
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password'=> 'required',
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/profil');
        }
        return back ()->withErrors([
            'email'=>'Email dan Password tidak cocok'
        ]);
    }
    // user login
    
    // user logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // form registrasi
    public function registrationForm(){
        return view ('user.registrasi');
    }  
    // simpan registrasi
     public function register(Request $request) {
        // cek isian form register
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
       // simpan ke dalam database
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($credentials['password']), // ubah ke format hash
        ]);


        Auth::login($user);
        return redirect()->intended('/profil')->with('success',
      'Pendaftaran Anda Berhasil'); // lempar ke halaman profil
     }

    public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

}
