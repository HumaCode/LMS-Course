<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
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

    public function adminBlogCategoryEdit($id)
    {
        $category = BlogCategory::findOrFail($id);

        return response()->json($category);
    }

    public function adminBlogCategoryUpdate(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'category_name'      => 'required|unique:blog_categories,category_name,' . $id,
            'category_slug'      => 'required',
        ]);

        BlogCategory::find($id)->update([
            'category_name' => $attr['category_name'],
            'category_slug' => $attr['category_slug'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Blog Category Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.blog.category')->with($notification);
    }

    public function adminDeleteBlogCategory($slug)
    {
        $data = BlogCategory::where('category_slug', $slug)->first();

        $data->delete();

        $notification = [
            'message'       => 'Blog Category Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }



    //////////////////////////////////// blog ////////////////////////////////
    public function adminBlogPost()
    {

        $title      = 'Blog Post';
        $subtitle   = 'blog post';
        $posts      = BlogPost::latest()->get();

        return view('admin.backend.posts.all_post', compact('title', 'subtitle', 'posts'));
    }

    public function adminAddBlogPost()
    {
        $title      = 'Add Blog Post';
        $subtitle   = 'add blog post';
        $blogcat    = BlogCategory::latest()->get();

        return view('admin.backend.posts.add_post', compact('title', 'subtitle', 'blogcat'));
    }

    public function checkBlogPostSlug(Request $request)
    {
        $slug = SlugService::createSlug(BlogPost::class, 'post_slug', $request->post_title);

        return response()->json(['post_slug' => $slug]);
    }
}
