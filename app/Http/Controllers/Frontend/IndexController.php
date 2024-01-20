<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function courseDetail($id, $slug)
    {
        $course = Course::find($id);

        return view('frontend.course.course_details', compact('course'));
    }
}
