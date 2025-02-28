<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginPage() {
        return view('auth.login');
    }

    public function registerPage() {
        return view('auth.register');
    }

    public function login(Request $request) {

        $user = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            // Redirection selon le rôle
            if ($user->role->name === 'admin') {

                return redirect('dashboard')->with('success', 'Bienvenue, Admin !');
            }  else {
                return redirect('index')->with('success', 'Connexion réussie !');
            }
        }
    }
    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    public function register(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        
        // Create the new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        
        // dd($user);

        // Automatically log the user in
        Auth::login($user);

        // Redirect to the dashboard or home page
        return redirect('/')->with('success', 'Registration successful!');
    }
}
