<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function allCourse()
    {
        $title      = 'All Courses';
        $subtitle   = 'all courses';
        $id         = Auth::user()->id;
        $courses    = Course::where('instructor_id', $id)->orderBy('id', 'desc')->get();

        return view('instructor.courses.all_course', compact('courses', 'title', 'subtitle'));
    }
}
