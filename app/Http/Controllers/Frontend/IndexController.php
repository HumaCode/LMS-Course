<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_goal;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function courseDetail($id, $slug)
    {
        $course = Course::with('category', 'subcategory', 'user')->find($id);
        $goals = Course_goal::where('course_id', $course->id)->orderBy('id', 'DESC')->get();

        return view('frontend.course.course_details', compact('course', 'goals'));
    }
}
