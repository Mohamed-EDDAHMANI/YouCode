<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // $clubs = Club::All();
        // $upcomingEvents = Event::with('club')->get();
        // , compact('upcomingEvents', 'clubs')
        return view('admin.dashboard');
    }
}
