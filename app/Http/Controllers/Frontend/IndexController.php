<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function courseDetail($id, $slug)
    {
        $course     = Course::with('category', 'subcategory', 'user')->find($id);
        $goals      = Course_goal::where('course_id', $course->id)->orderBy('id', 'DESC')->get();
        $lecture    = CourseLecture::where('course_id', $course->id)->get();
        $sections   = CourseSection::where('course_id', $course->id)->orderBy('id', 'ASC')->get();

        return view('frontend.course.course_details', compact('course', 'goals', 'lecture', 'sections'));
    }
}
