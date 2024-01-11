<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
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

    public function addCourse()
    {
        $title          = 'Add Courses';
        $subtitle       = 'add courses';
        $categories     = Category::latest()->get();


        return view('instructor.courses.add_course', compact('categories', 'title', 'subtitle'));
    }

    public function checkSlugCourse(Request $request)
    {
        $slug = SlugService::createSlug(Course::class, 'course_name_slug', $request->course_name);

        return response()->json(['course_name_slug' => $slug]);
    }

    public function getSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();

        return json_encode($subcat);
    }
}
