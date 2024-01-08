<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('show.login');
    }



    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home.index');
        } else {

            return back()->with('error', 'Invalid credentials');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('show.login');
    }
}
