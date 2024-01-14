<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use PHPUnit\Framework\Constraint\Count;

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
        $images = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($images);

        $image->resize(370, 246);
        $image->save('upload/course_asset/thumbnail/' . $name_gen);

        $save_url = 'upload/course_asset/thumbnail/' . $name_gen;

        // course video
        $video = $request->file('video');
        $video_name = time() . '.' . $video->getClientOriginalExtension();

        $video->move(public_path('upload/course_asset/video'), $video_name);
        $save_video = 'upload/course_asset/thumbnail/' . $video_name;

        try {
            DB::beginTransaction();

            $course_id = Course::insertGetId([
                'category_id'       => $attr['category_id'],
                'subcategory_id'    => $attr['subcategory_id'],
                'subcategory_id'    => $attr['subcategory_id'],
                'instructor_id'     => Auth::user()->id,
                'course_title'      => $attr['course_name'],
                'course_name_slug'  => $attr['course_name_slug'],
                'description'       => $attr['description'],
                'video'             => $save_video,

                'label'             => $attr['label'],
                'duration'          => $attr['duration'],
                'resources'         => $attr['resources'],
                'certificate'       => $attr['certificate'],
                'selling_price'     => $attr['selling_price'],
                'discount_price'    => $attr['discount_price'],
                'prerequisites'     => $attr['prerequisites'],

                'bestseller'        => $request->bestseller,
                'featured'          => $request->featured,
                'highestrated'      => $request->highestrated,
                'status'            => 1,
                'course_image'      => $save_url,
                'created_at'        => Carbon::now(),
                // 'updated_at'        => Carbon::now(),
            ]);


            // goals
            $goals = count($request->course_goals);
            if ($goals > 0) {
                for ($i = 0; $i < $goals; $i++) {
                    $goal_name = $request->course_goals[$i];

                    // Check apakah $goal_name tidak kosong sebelum menyimpan
                    if (!empty($goal_name)) {
                        $g = new Course_goal();
                        $g->course_id = $course_id;
                        $g->goal_name = $request->course_goals[$i];
                        $g->save(); // Simpan ke database jika diperlukan
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();

            throw $th;
        }

        $notification = [
            'message'       => 'Course Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('all.course')->with($notification);
    }
}
