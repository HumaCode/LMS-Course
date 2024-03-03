<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function adminBlogCategory()
    {
        $title      = 'Blog Category';
        $subtitle   = 'blog category';
        $categories = BlogCategory::latest()->get();

        return view('admin.backend.blogcategory.blog_category', compact('title', 'subtitle', 'categories'));
    }



    public function checkBlogCategorySlug(Request $request)
    {
        $slug = SlugService::createSlug(BlogCategory::class, 'category_slug', $request->category_name);

        return response()->json(['category_slug' => $slug]);
    }

    public function adminBlogCategoryStore(Request $request)
    {
        $attr = $request->validate([
            'category_name'      => 'required',
            'category_slug'      => 'required',
        ]);

        BlogCategory::insert([
            'category_name' => $attr['category_name'],
            'category_slug' => $attr['category_slug'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Blog Category Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.blog.category')->with($notification);
    }
}
