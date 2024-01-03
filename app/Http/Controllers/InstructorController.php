<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function instructorDashboard()
    {
        return view('instructor.index');
    }

    public function instructorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }

    public function instructorLogin()
    {
        return view('instructor.instructor_login');
    }
}
