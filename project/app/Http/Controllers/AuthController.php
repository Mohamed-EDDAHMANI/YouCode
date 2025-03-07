<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

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

    public function register(RegisterRequest $request)
    {   
        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        $cinPath = $request->file('cin')->store('cin_images', 'public');

        Candidat::create([
            'phone' => $request->phone,
            'address' => $request->address,
            'dateBorn' => $request->dateBorn,
            'cin' => $cinPath,
            'user_id' => $user->id,
        ]);


        
        // dd($user);

        // Automatically log the user in
        Auth::login($user);

        // Redirect to the dashboard or home page
        return redirect('welcome')->with('success', 'Registration successful!');
    }
}
