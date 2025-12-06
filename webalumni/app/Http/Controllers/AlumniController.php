<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        return view('alumni.index');
    }

    public function create()
    {
        return view('auth.alumni');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:alumni'],
            'password' => ['required', 'min:6'],
        ]);

        // Hash password dan simpan ke database
        $credentials['password'] = bcrypt($credentials['password']);
        
        if (Register::create($credentials)) {
            return redirect('/forum')->with('success', 'Registration successful!');
        } else {
            return back()->withErrors([
                'email' => 'Registration failed. Please try again.',
            ])->onlyInput('email');
        }
    }

    public function show($id)
    {
        $register = Register::find($id);
        return view('register.show', compact('register'));
    }

    public function edit($id)
    {
        $register = Register::find($id);
        return view('register.edit', compact('register'));
    }

    public function update(Request $request, $id)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:alumni,email,'.$id],
            'password' => ['nullable', 'min:6'],
        ]);

        if ($credentials['password']) {
            $credentials['password'] = bcrypt($credentials['password']);
        } else {
            unset($credentials['password']);
        }

        Register::find($id)->update($credentials);
        return redirect('/forum')->with('success', 'Update successful!');
    }

    public function destroy($id)
    {
        Register::find($id)->delete();
        return redirect('/forum')->with('success', 'Delete successful!');
    }
}
