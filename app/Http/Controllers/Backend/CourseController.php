<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

    public function storeCourse(Request $request)
    {
        $attr = $request->validate([
            'course_name'           => 'required',
            'course_name_slug'      => 'required|unique:courses,course_name_slug',
            'category_id'           => 'required|exists:categories,id',
            'subcategory_id'        => 'required|exists:sub_categories,id',
            'course_image'          => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'video'                 => 'required|mimes:mp4|max:10000',
            'certificate'           => 'required',
            'label'                 => 'required',
            'selling_price'         => 'required',
            'discount_price'        => 'required',
            'duration'              => 'required',
            'resources'             => 'required',
            'prerequisites'         => 'required',
            'description'           => 'required',
        ]);

        // course image
        $images = $request->file($attr['course_image']);
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($images);

        $image->resize(370, 246);
        $image->save('upload/course_asset/thumbnail/' . $name_gen);

        $save_url = 'upload/course_asset/thumbnail/' . $name_gen;

        // course video
        $video = $request->file($attr['video']);
        $video_name = time() . '.' . $video->getClientOriginalExtension();

        $video->move(public_path('upload/course_asset/video'), $video_name);
        $save_video = 'upload/course_asset/thumbnail/' . $video_name;
    }
}
