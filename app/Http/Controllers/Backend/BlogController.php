<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
        $posts      = BlogPost::with('blogcat')->latest()->get();

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

    public function storeBlogPost(Request $request)
    {
        $attr = $request->validate([
            'blogcat_id'    => 'required|exists:blog_categories,id',
            'post_title'    => 'required',
            'post_slug'     => 'required',
            'post_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'long_descp'    => 'required',
            'post_tag'      => 'required',
        ]);


        $images = $request->file('post_image');

        if ($images) {
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($images);

            $image->resize(370, 247);
            $image->save('upload/blog_post/' . $name_gen);

            $save_url = 'upload/blog_post/' . $name_gen;
        } else {
            $save_url = Null;
        }


        BlogPost::insert([
            'blogcat_id'    => $attr['blogcat_id'],
            'post_title'    => $attr['post_title'],
            'post_slug'     => $attr['post_slug'],
            'long_descp'    => $attr['long_descp'],
            'post_tag'      => $attr['post_tag'],
            'post_image'    => $save_url,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Blog Post Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.blog.post')->with($notification);
    }

    public function adminEditBlogPost($slug)
    {
        $title      = 'Edit Blog Post';
        $subtitle   = 'edit blog post';
        $blogcat    = BlogCategory::latest()->get();
        $blog       = BlogPost::where('post_slug', $slug)->first();

        return view('admin.backend.posts.edit_post', compact('title', 'subtitle', 'blog', 'blogcat'));
    }

    public function updateBlogPost(Request $request)
    {
        $id = $request->id;
        $data = BlogPost::findOrFail($id);

        $attr = $request->validate([
            'blogcat_id'    => 'required|exists:blog_categories,id',
            'post_title'    => 'required',
            'post_slug'     => 'required',
            'post_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
            'long_descp'    => 'required',
            'post_tag'      => 'required',
        ]);

        if ($request->file('post_image')) {

            // unlink foto
            if ($data->post_image <> "") {
                unlink($data->post_image);
            }

            $images = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($images);

            $image->resize(370, 247);
            $image->save('upload/blog_post/' . $name_gen);

            $save_url = 'upload/blog_post/' . $name_gen;

            $data->update([
                'blogcat_id'    => $attr['blogcat_id'],
                'post_title'    => $attr['post_title'],
                'post_slug'     => $attr['post_slug'],
                'long_descp'    => $attr['long_descp'],
                'post_tag'      => $attr['post_tag'],
                'post_image'    => $save_url,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        } else {
            $data->update([
                'blogcat_id'    => $attr['blogcat_id'],
                'post_title'    => $attr['post_title'],
                'post_slug'     => $attr['post_slug'],
                'long_descp'    => $attr['long_descp'],
                'post_tag'      => $attr['post_tag'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }

        $notification = [
            'message'       => 'Blog Post Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.blog.post')->with($notification);
    }
}
