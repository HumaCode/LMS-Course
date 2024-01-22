<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function courseDetail($id, $slug)
    {
        $course             = Course::with('category', 'subcategory', 'user')->find($id);
        $goals              = Course_goal::where('course_id', $course->id)->orderBy('id', 'DESC')->get();
        $lecture            = CourseLecture::where('course_id', $course->id)->get();
        $sections           = CourseSection::where('course_id', $course->id)->orderBy('id', 'ASC')->get();

        $categories         = Category::latest()->get();
        $cat_id             = $course->category_id;
        $relatedCourses     = Course::with('user')->where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();


        $inst_id            = $course->instructor_id;
        $instructorCourses  = Course::where('instructor_id', $inst_id)->orderBy('id', 'DESC')->get();

        return view('frontend.course.course_details', compact('course', 'goals', 'lecture', 'sections', 'instructorCourses', 'categories', 'relatedCourses'));
    }

    public function categoryCourse($id, $slug)
    {
        $courses        = Course::with('user')->where('category_id', $id)->where('status', '1')->get();
        $category       = Category::where('id', $id)->first();
        $categories     = Category::latest()->get();


        return view('frontend.category.category_all', compact('courses', 'category', 'categories'));
    }
}
