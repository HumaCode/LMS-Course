<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function instructorDashboard()
    {
        return view('instructor.instructor_dashboard');
    }
}
