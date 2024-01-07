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
    

    // Hash the password before creating the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'position' => $request->position,
        'password' => bcrypt($request->password), // Hashing the password using bcrypt
    ]);

    // Redirect to the login page after successful registration
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

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Authentication successful, redirect to the home page
        return redirect()->route('home.index'); // Make sure 'home.index' is the correct route name
    } else {
        // Authentication failed, redirect back with an error message
        return back()->with('error', 'Invalid credentials');
    }
}


public function logout()
{
    Auth::logout();
    return redirect()->route('show.login'); 
}
}
